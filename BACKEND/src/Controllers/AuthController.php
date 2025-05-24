<?php

namespace App\Controllers;

use App\Helpers\CallApi;
use App\Helpers\FileSave;
use App\Helpers\Hash;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\JWTHelper;
use App\Helpers\Log;
use App\Helpers\Validator;
use App\Helpers\SendMessage;
use App\Models\AccountModel;
use App\Models\MessageModel;
use App\Models\SellerModel;
use App\Models\UserModel;
use Google_Client;

class AuthController {
    // Đăng nhập bằng google
    public function loginGoogle() {
        try {
            $access_token = Request::json('access_token');
            $payload = null;

            try {
                $payload = CallApi::get(
                    'https://www.googleapis.com/oauth2/v2/userinfo',
                    ['Authorization: Bearer ' . $access_token]
                );
            } catch (\Throwable $th) {
                Response::json(['message' => 'Access token không hợp lệ'], 401);
            }

            if (!$payload) {
                Response::json(['message' => 'Access token không hợp lệ'], 401);
            }

            if ($payload) {
                // Lấy thông tin user
                $email = $payload['email'];
                $name = $payload['name'];
                $googleId = $payload['id'];
                $avatar = $payload['picture'];

                $account = AccountModel::findByGoogleId($googleId);

                if (!$account) {
                    $account_id = AccountModel::addWithGoogle($email, $googleId, 'user', 'unverified');
                    $file_save = FileSave::avatarImageFromUrl($avatar);
                    if ($file_save && $file_save['success']) {
                        UserModel::addUser2($name, $account_id, $file_save['file_name']);
                    } else {
                        UserModel::addUser($name, $account_id);
                    }
                    Response::json([
                        'message' => 'Vui lòng thêm số điện thoại để hoàn thành tạo tài khoản',
                        'account_id' => Hash::encodeAes($account_id)
                    ], 409);
                }

                if ($account['status'] === 'active') {
                    $this->handleLogin($account);
                }

                Response::json([
                    'message' => 'Vui lòng thêm số điện thoại để hoàn thành tạo tài khoản',
                    'account_id' =>  Hash::encodeAes($account['account_id'])
                ], 409);

                if ($account['status'] == 'inactive') {
                    Response::json(['message' => 'Tài khoản chưa hoạt động'], 400);
                }

                if ($account['status'] == 'locked') {
                    Response::json(['message' => 'Tài khoản đã bị khóa'], 400);
                }
            } else {
                Response::json(['message' => 'Không tìm thấy thông tin người dùng'], 404);
            }
            Response::json($_POST, 200);
        } catch (\Throwable $th) {
            Log::throwable("AuthController -> loginGoogle: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy mã xác nhận số điện thoại đăng nhập bằng google
    public function loginGoogleCode() {
        try {
            $phone = Request::json('phone');
            $account_id = Request::json('account_id');
            $account_id = Hash::decodeAes($account_id);

            $checkPhone = Validator::isPhone($phone);
            if ($checkPhone !== true) {
                Response::json(['message' => $checkPhone], 400);
            }

            $account = AccountModel::findByPhone($phone);

            if ($account) {
                Response::json(['message' => 'Số điện thoại đã được sử dụng'], 409);
            }

            $account = AccountModel::findById($account_id);
            if (!$account) {
                Response::json(['message' => 'Tài khoản không tìm thấy'], 404);
            }

            if ($account['status'] == 'active') {
                Response::json(['message' => 'Tài khoản đã hoạt động'], 400);
            }

            if ($account['status'] == 'inactive') {
                Response::json(['message' => 'Tài khoản chưa hoạt động'], 400);
            }

            if ($account['status'] == 'locked') {
                Response::json(['message' => 'Tài khoản được bị khóa'], 400);
            }

            if ($account['status'] == 'unverified') {
                $send = SendMessage::sendMessageCode(
                    $phone,
                    $account_id
                );

                if ($send) {
                    AccountModel::updatePhone($account_id, $phone);
                    Response::json(['message' => 'Mã xác nhận đã được gửi về điện thoại'], 201);
                } else {
                    throw new \Throwable();
                }
            }

            throw new \Throwable();
        } catch (\Throwable $th) {
            Log::throwable("AuthController -> loginGoogleCode: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Xác thực số điện thoại dăng nhập bằng google
    public function loginGoogleVerify() {
        try {
            $account_id = Request::json('account_id');
            $account_id = Hash::decodeAes($account_id);
            $phone = Request::json('phone');
            $code = Request::json('code');

            if (!$account_id || !$code) {
                Response::json(['message' => 'Thông tin không đủ'], 409);
            }

            $account = AccountModel::findByPhone($phone);

            if (!$account) {
                Response::json(['message' => 'Số điện thoại không đúng'], 404);
            }

            if ($account['status'] == 'active') {
                Response::json(['message' => 'Tài khoản đã hoạt động'], 400);
            }

            if ($account['status'] == 'inactive') {
                Response::json(['message' => 'Tài khoản chưa hoạt động'], 400);
            }

            if ($account['status'] == 'locked') {
                Response::json(['message' => 'Tài khoản được bị khóa'], 400);
            }

            $message = MessageModel::getLastMessage($account_id);

            if (!$message) {
                Response::json(['message' => 'Vui lòng lấy mã xác nhận'], 409);
            }

            if (!$code) {
                Response::json(['message' => 'Vui lòng nhập mã xác nhận'], 409);
            }

            if (!Hash::verifyArgon2i($code, $message['code'])) {
                Response::json(['message' => 'Mã xác nhận không khớp'], 400);
            }

            if (!SendMessage::checkMessageCodeExpired($message['created_at'])) {
                Response::json(['message' => 'Mã xác nhận hết hạn'], 400);
            }

            AccountModel::updateStatus($account_id, 'active');

            $this->handleLogin($account);
        } catch (\Throwable $th) {
            Log::throwable("AuthController -> loginGoogleVerify: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Đăng ký
    public function register() {
        try {
            $name = Request::json('name');
            $phone = Request::json('phone');
            $password = Request::json('password');
            $code = Request::json('code');

            $account = AccountModel::findByPhone($phone);

            if (!$account) {
                Response::json(['message' => 'Số điện thoại chưa được xác thực'], 409);
            }

            if ($account['status'] == 'inactive') {
                if (!$account) {
                    AccountModel::addAccount($phone, $password, 'user', 'inactive');
                    $account_new = AccountModel::findByPhone($phone);
                    UserModel::addUser($name, $account_new['account_id']);
                }
                $account_new = AccountModel::findByPhone($phone);

                if (!Hash::verifyArgon2i($password, $account_new['password'])) {
                    Response::json(['message' => 'Mật khẩu không đúng'], 400);
                }

                $message = MessageModel::getLastMessage($account_new['account_id']);

                if (!$message) {
                    Response::json(['message' => 'Vui lòng lấy mã xác nhận'], 409);
                }

                if (!$code) {
                    Response::json(['message' => 'Vui lòng nhập mã xác nhận'], 409);
                }

                if (!Hash::verifyArgon2i($code, $message['code'])) {
                    Response::json(['message' => 'Mã xác nhận không khớp'], 400);
                }

                if (!SendMessage::checkMessageCodeExpired($message['created_at'])) {
                    Response::json(['message' => 'Mã xác nhận hết hạn'], 400);
                }

                MessageModel::deleteMessage($message['message_id']);
                AccountModel::activeAccount($account_new['account_id']);

                $this->handleLogin($account_new);
            } else {
                Response::json(['message' => 'Số điện thoại đã được đăng ký'], 400);
            }
        } catch (\Throwable $th) {
            Log::throwable("AuthController -> register: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy mã xác nhận đăng ký
    public function getCodeRegister() {
        try {
            $name = Request::json('name');
            $phone = Request::json('phone');
            $password = Request::json('password');

            // Kiểm tra thông tin đăng ký
            $this->checkInfoRegister($name, $phone, $password);

            $account = AccountModel::findByPhone($phone);
            if (!$account || $account['status'] == 'inactive') {
                if (!$account) {
                    AccountModel::addAccount($phone, $password, 'user', 'inactive');
                    $account_new = AccountModel::findByPhone($phone);
                    UserModel::addUser($name, $account_new['account_id']);
                }
                $account_new = AccountModel::findByPhone($phone);

                if (!Hash::verifyArgon2i($password, $account_new['password'])) {
                    Response::json(['message' => 'Mật khẩu không đúng'], 400);
                }

                $result = SendMessage::sendMessageCode($account_new['phone'], $account_new['account_id']);

                $res = [
                    'message' => 'Vui lòng nhập mã xác nhận được gửi về điện thoại',
                ];

                if (isset($result['message'])) {
                    $res['message_body'] = $result['message'];
                }

                if ($result) {
                    Response::json($res, 201);
                } else {
                    throw new \Exception("Lỗi gửi mã xác nhận");
                }
            } else {
                Response::json(['message' => 'Số điện thoại đã được đăng ký'], 400);
            }
        } catch (\Throwable $th) {
            Log::throwable("AuthController -> getCodeRegister: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Đăng nhập
    public function login() {
        try {
            $phone = Request::json('phone');
            $password = Request::json('password');
            $code = Request::json('code');

            // Kiểm tra tài khoản
            $account = AccountModel::findByPhone($phone);
            if (!$account || !Hash::verifyArgon2i($password, $account['password'])) {
                Response::json(['message' => 'Sai số điện thoại hoặc mật khẩu'], 401);
            }

            // Kiểm tra trạng thái
            if ($account['status'] == 'inactive') {
                Response::json(['message' => 'Tài khoản chưa hoạt động'], 400);
            } else if ($account['status'] == 'locked') {
                Response::json(['message' => 'Tài khoản đã bị khóa'], 400);
            } else if ($account['status'] == 'unverified') {
                Response::json(['message' => 'Tài khoản chưa xác thực'], 400);
            }

            // Kiểm tra thiết bị lạ đăng nhập
            $account_id = $account['account_id'];
            $ip_address = Request::getServer('REMOTE_ADDR');
            $user_agent = Request::getServer('HTTP_USER_AGENT');

            if (!$account['device_token'] || !Hash::verifyArgon2i($ip_address . $user_agent, $account['device_token'])) {
                $message = MessageModel::getLastMessage($account_id);

                if (!$message) {
                    Response::json(['message' => 'Vui lòng lấy mã xác nhận'], 409);
                }

                if (!$code) {
                    Response::json(['message' => 'Vui lòng nhập mã xác nhận'], 409);
                }

                if (!Hash::verifyArgon2i($code, $message['code'])) {
                    Response::json(['message' => 'Mã xác nhận không khớp'], 400);
                }

                if (!SendMessage::checkMessageCodeExpired($message['created_at'])) {
                    Response::json(['message' => 'Mã xác nhận hết hạn'], 400);
                }

                MessageModel::deleteMessage($message['message_id']);
            }

            $this->handleLogin($account);
        } catch (\Throwable $th) {
            Log::throwable("AuthController -> login: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy mã xác nhận đăng nhập
    public function getCodeLogin() {
        try {
            $phone = Request::json('phone');
            $password = Request::json('password');

            // Kiểm tra tài khoản
            $account = AccountModel::findByPhone($phone);
            if (!$account || !Hash::verifyArgon2i($password, $account['password'])) {
                Response::json(['message' => 'Sai số điện thoại hoặc mật khẩu'], 401);
            }

            $result = SendMessage::sendMessageCode($account['phone'], $account['account_id']);

            $res = [
                'message' => 'Vui lòng nhập mã xác nhận được gửi về điện thoại',
            ];

            if (isset($result['message'])) {
                $res['message_body'] = $result['message'];
            }

            if ($result) {
                Response::json($res, 201);
            } else {
                throw new \Exception("Lỗi gửi mã xác nhận");
            }
        } catch (\Throwable $th) {
            Log::throwable("AuthController -> login: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Private handle login
    private function handleLogin($account) {
        try {
            // Thêm thông tin thiết bị
            $ip_address = Request::getServer('REMOTE_ADDR');
            $user_agent = Request::getServer('HTTP_USER_AGENT');

            AccountModel::updateDeviceToken($account['account_id'], $ip_address, $user_agent);

            // Tạo Access Token và Refresh Token
            $accessToken = JWTHelper::generateToken($account['account_id']);
            $refreshToken = JWTHelper::generateToken($account['account_id'], true);

            // Cập nhật token vào CSDL
            AccountModel::updateTokens($account['account_id'], $accessToken, $refreshToken);

            // Thông tin tài khoản
            if ($account['role'] == 'user') {
                $account = UserModel::findById($account['account_id']);
            } else if ($account['role'] == 'seller') {
                $account = SellerModel::findById($account['account_id']);
            } else if ($account['role'] == 'admin') {
                $result['account_id'] = $account['account_id'];
                $result['phone'] = $account['phone'];
                $result['role'] = $account['role'];
                $result['status'] = $account['status'];
                $result['created_at'] = $account['created_at'];
                $account = $result;
            } else if ($account['role'] == 'shipper') {
                $result['account_id'] = $account['account_id'];
                $result['phone'] = $account['phone'];
                $result['role'] = $account['role'];
                $result['coin'] = $account['coin'];
                $result['bank_number'] = $account['bank_number'];
                $result['bank_name'] = $account['bank_name'];
                $result['status'] = $account['status'];
                $result['created_at'] = $account['created_at'];
                $account = $result;
            } else {
                Response::json(['message' => 'Vai trò không hợp lệ'], 400);
            }

            Log::login([
                'account_id' => $account['account_id'],
                'ip_address' => $ip_address,
                'user_agent' => $user_agent
            ]);

            Response::json([
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
                'account' => $account
            ]);
        } catch (\Throwable $th) {
            Log::throwable("AuthController -> handleLogin: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Refresh token
    public function refreshToken() {
        try {
            $refreshToken = Request::json('refresh_token');

            // Kiểm tra token hợp lệ
            $decoded = JWTHelper::verifyToken($refreshToken);
            if (!$decoded) {
                Response::json(['message' => 'Refresh token không hợp lệ'], 401);
            }

            $account = AccountModel::findById($decoded->account_id);

            if ($account["status"] === "inactive") {
                Response::json(['message' => 'Tài khoản chưa hoạt động'], 401);
            }

            if ($account["status"] === "unverified") {
                Response::json(['message' => 'Tài khoản chưa được xác thực'], 401);
            }

            if ($account["status"] === "locked") {
                Response::json(['message' => 'Tài khoản đã bị khóa'], 401);
            }

            if (!$account || $account['refresh_token'] !== $refreshToken) {
                Response::json(['message' => 'Refresh token không hợp lệ'], 401);
            }

            // Kiểm tra thiết bị lạ đăng nhập
            $ip_address = Request::getServer('REMOTE_ADDR');
            $user_agent = Request::getServer('HTTP_USER_AGENT');

            if (!$account['device_token'] || !Hash::verifyArgon2i($ip_address . $user_agent, $account['device_token'])) {
                Response::json(['message' => 'Thiết bị lạ, vui lòng đăng nhập lại'], 401);
            }

            // Tạo token mới
            $newAccessToken = JWTHelper::generateToken($account['account_id']);
            $newRefreshToken = JWTHelper::generateToken($account['account_id'], true);

            // Cập nhật token vào CSDL
            AccountModel::updateTokens($account['account_id'], $newAccessToken, $newRefreshToken);

            // Thông tin tài khoản
            if ($account['role'] == 'user') {
                $account = UserModel::findById($account['account_id']);
            } else if ($account['role'] == 'seller') {
                $account = SellerModel::findById($account['account_id']);
            }

            Response::json([
                'access_token' => $newAccessToken,
                'refresh_token' => $newRefreshToken,
                'account' => $account
            ]);
        } catch (\Throwable $th) {
            Log::throwable("AuthController -> refreshToken: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Đăng xuất
    public function logout() {
        try {
            // Lấy access token từ request
            $accessToken = Request::getHeader('Authorization');

            if (!$accessToken) {
                Response::json(['message' => 'Không tìm thấy access token'], 401);
            }

            // Loại bỏ 'Bearer ' nếu có
            $accessToken = str_replace('Bearer ', '', $accessToken);

            // Xác thực token
            $decoded = JWTHelper::verifyToken($accessToken);
            if (!$decoded) {
                Response::json(['message' => 'Access token không hợp lệ'], 401);
            }

            // Lấy ID từ access token
            $id = $decoded->account_id;

            // Xóa access_token và refresh_token khỏi database
            AccountModel::updateTokens($id, null, null);

            Response::json(['message' => 'Đăng xuất thành công']);
        } catch (\Throwable $th) {
            Log::throwable("AuthController -> logout: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Kiểm tra đăng ký
    private function checkInfoRegister($name, $phone, $password) {
        // Kiểm tra tên tài khoản
        $nameCheck = Validator::isName($name, 'Tên tài khoản', 3, 20);
        if ($nameCheck !== true) {
            Response::json(['message' => $nameCheck], 400);
        }

        // Kiểm tra số điện thoại hợp lệ
        $phoneCheck = Validator::isPhone($phone);
        if ($phoneCheck !== true) {
            Response::json(['message' => $phoneCheck], 400);
        }

        // Kiểm tra độ mạnh của mật khẩu
        $passwordCheck = Validator::isPasswordStrength($password);
        if ($passwordCheck !== true) {
            Response::json(['message' => $passwordCheck], 400);
        }
    }

    // Lấy lại mật khẩu
    public function forgotPassword() {
        try {
            $phone = Request::json('phone');
            $passwordNew = Request::json('password');
            $code = Request::json('code');

            $account = AccountModel::findByPhone($phone);
            if (!$account) {
                Response::json(['message' => 'Tài khoản không tồn tại'], 400);
            }

            // Kiểm tra độ mạnh của mật khẩu
            $passwordCheck = Validator::isPasswordStrength($passwordNew);
            if ($passwordCheck !== true) {
                Response::json(['message' => $passwordCheck], 400);
            }

            $message = MessageModel::getLastMessage($account['account_id']);
            if (!$message) {
                Response::json(['message' => 'Vui lòng lấy mã xác nhận'], 409);
            }

            if (!$code) {
                Response::json(['message' => 'Vui lòng nhập mã xác nhận'], 409);
            }

            if (!Hash::verifyArgon2i($code, $message['code'])) {
                Response::json(['message' => 'Mã xác nhận không khớp'], 400);
            }

            if (!SendMessage::checkMessageCodeExpired($message['created_at'])) {
                Response::json(['message' => 'Mã xác nhận hết hạn'], 400);
            }

            MessageModel::deleteMessage($message['message_id']);
            AccountModel::updatePassword($account['account_id'], $passwordNew);

            $account = AccountModel::findById($account['account_id']);

            $this->handleLogin($account);
        } catch (\Throwable $th) {
            Log::throwable("AuthController -> forgotPassword: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy mã xác nhận lấy lại mật khẩu
    public function getCodeForgotPassword() {
        try {
            $phone = Request::json('phone');
            $passwordNew = Request::json('password');

            $account = AccountModel::findByPhone($phone);
            if (!$account) {
                Response::json(['message' => 'Tài khoản không tồn tại'], 400);
            }

            $passwordCheck = Validator::isPasswordStrength($passwordNew);
            if ($passwordCheck !== true) {
                Response::json(['message' => $passwordCheck], 400);
            }

            $result = SendMessage::sendMessageCode($account['phone'], $account['account_id']);

            $res = [
                'message' => 'Vui lòng nhập mã xác nhận được gửi về điện thoại',
            ];

            if (isset($result['message'])) {
                $res['message_body'] = $result['message'];
            }

            if ($result) {
                Response::json($res, 201);
            } else {
                throw new \Exception("Lỗi gửi mã xác nhận");
            }
        } catch (\Throwable $th) {
            Log::throwable("AuthController -> forgotPassword: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Đăng ký người bán
    public function registerSeller() {
        try {
            $phone = Request::json('phone');
            $password = Request::json('password');
            $store_name = Request::json('store_namme');
            $owner_name = Request::json('owner_name');
            $description = Request::json('description');
            $bank_number = Request::json('bank_number');
            $bank_name = Request::json('bank_name');

            $account = AccountModel::findByPhone($phone);
            if ($account) {
                Response::json(['message' => 'Số điện thoại đã được đăng ký'], 400);
            }

            $phoneCheck = Validator::isPhone($phone);
            if ($phoneCheck !== true) {
                Response::json(['message' => $phoneCheck], 400);
            }

            $passwordCheck = Validator::isPasswordStrength($password);
            if ($passwordCheck !== true) {
                Response::json(['message' => $passwordCheck], 400);
            }

            $storeNameCheck = Validator::isText($store_name, 'Tên cửa hàng', 3, 100);
            if ($storeNameCheck !== true) {
                Response::json(['message' => $storeNameCheck], 400);
            }

            $ownerNameCheck = Validator::isText($owner_name, 'Tên chủ cửa hàng', 3, 50);
            if ($ownerNameCheck !== true) {
                Response::json(['message' => $ownerNameCheck], 400);
            }

            $descriptionCheck = Validator::isText($description, 'Mô tả', 1, 10000);
            if ($descriptionCheck !== true) {
                Response::json(['message' => $descriptionCheck], 400);
            }

            Response::json(['message' => 'Đăng ký người bán thành công'], 200);
        } catch (\Throwable $th) {
            Log::throwable("AuthController -> registerSeller: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
