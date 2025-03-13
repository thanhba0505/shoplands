<?php

namespace App\Controllers;

use App\Helpers\Hash;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\JwtHelper;
use App\Helpers\Log;
use App\Helpers\Validator;
use App\Helpers\SendMessage;
use App\Models\AccountModel;
use App\Models\DeviceLoginModel;
use App\Models\MessageModel;
use App\Models\SellerModel;
use App\Models\UserModel;
use App\Models\VerificationCodeModel;
use Exception;

class AuthController
{
    // Đăng ký
    public function register()
    {
        $name = Request::json('name');
        $phone = Request::json('phone');
        $password = Request::json('password');
        $code = Request::json('code');

        // Kiểm tra thông tin đăng ký
        $this->checkInfoRegister($name, $phone, $password);

        try {
            $account = AccountModel::findByPhone($phone);
            if (!$account || $account['status'] == 'inactive') {
                if (!$account) {
                    AccountModel::addAccount($phone, $password, 'user', 'inactive');
                    $account_new = AccountModel::findByPhone($phone);
                    UserModel::addUser($name, $account_new['account_id']);
                }
                $account_new = AccountModel::findByPhone($phone);

                $message = MessageModel::getLastMessage($account_new['account_id']);

                if ($code && $message) {
                    if (!Hash::verifyArgon2i($code, $message['code'])) {
                        Response::json(['message' => 'Mã xác nhận không khớp'], 400);
                    }

                    if (!SendMessage::checkMessageCodeExpired($message['created_at'])) {
                        Response::json(['message' => 'Mã xác nhận hết hạn'], 400);
                    }

                    AccountModel::activeAccount($account_new['account_id']);

                    $this->handleLogin($account_new);
                } else {
                    $result = SendMessage::sendMessageCode($phone, $account_new['account_id']);

                    if ($result) {
                        Response::json(['message' => 'Vui lòng nhập mã xác nhận được gửi về điện thoại'], 409);
                    }
                }
                Response::json(['message' => 'Đăng ký thất bại'], 500);
            } else {
                Response::json(['message' => 'Tài khoản đã đăng ký'], 409);
            }
        } catch (\Exception $e) {
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Đăng nhập
    public function login()
    {
        $phone = Request::json('phone');
        $password = Request::json('password');
        $code = Request::json('code');

        // Kiểm tra tài khoản
        $account = AccountModel::findByPhone($phone);
        if (!$account || !Hash::verifyArgon2i($password, $account['password'])) {
            Response::json(['message' => 'Sai số điện thoại hoặc mật khẩu'], 401);
        }

        // Kiểm tra thiết bị lạ đăng nhập
        $account_id = $account['account_id'];
        $ip_address = Request::getServer('REMOTE_ADDR');
        $user_agent = Request::getServer('HTTP_USER_AGENT');

        if (!$account['device_token'] || !Hash::verifyArgon2i($ip_address . $user_agent, $account['device_token'])) {
            // Gửi sms và tạo
            $message = MessageModel::getLastMessage($account_id);
            if ($code && $message) {
                if (!Hash::verifyArgon2i($code, $message['code'])) {
                    Response::json(['message' => 'Mã xác nhận không khớp'], 400);
                }

                if (!SendMessage::checkMessageCodeExpired($message['created_at'])) {
                    Response::json(['message' => 'Mã xác nhận hết hạn'], 400);
                }

                // Tiếp tục đăng nhập nếu đúng
                Log::login(['ip_address' => $ip_address, 'user_agent' => $user_agent], 'Số điện thoại: ' . $account['phone']);
                $this->handleLogin($account);
            } else {
                $result = SendMessage::sendMessageCode($account['phone'], $account_id);

                if ($result) {
                    Response::json(['message' => 'Vui lòng nhập mã xác nhận được gửi về điện thoại'], 409);
                }
            }
        }
    }

    // Private handle login
    private function handleLogin($account)
    {
        // Thêm thông tin thiết bị
        $ip_address = Request::getServer('REMOTE_ADDR');
        $user_agent = Request::getServer('HTTP_USER_AGENT');

        AccountModel::updateDeviceToken($account['account_id'], $ip_address, $user_agent);

        // Tạo Access Token và Refresh Token
        $accessToken = JwtHelper::generateToken($account['account_id']);
        $refreshToken = JwtHelper::generateToken($account['account_id'], true);

        // Cập nhật token vào CSDL
        AccountModel::updateTokens($account['account_id'], $accessToken, $refreshToken);

        // Thông tin tài khoản
        if ($account['role'] == 'user') {
            $account = UserModel::findById($account['account_id']);
        } else if ($account['role'] == 'seller') {
            $account = SellerModel::findById($account['account_id']);
        }

        Response::json([
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'account' => $account
        ]);
    }

    // Refresh token
    public function refreshToken()
    {
        $refreshToken = Request::json('refresh_token');

        // Kiểm tra token hợp lệ
        $decoded = JwtHelper::verifyToken($refreshToken);
        if (!$decoded) {
            Response::json(['message' => 'Refresh token không hợp lệ'], 401);
        }

        $account = AccountModel::findById($decoded->account_id);
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
        $newAccessToken = JwtHelper::generateToken($account['account_id']);
        $newRefreshToken = JwtHelper::generateToken($account['account_id'], true);

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
    }

    // Đăng xuất
    public function logout()
    {
        // Lấy access token từ request
        $accessToken = Request::getHeader('Authorization');

        if (!$accessToken) {
            Response::json(['message' => 'Không tìm thấy access token'], 401);
        }

        // Loại bỏ 'Bearer ' nếu có
        $accessToken = str_replace('Bearer ', '', $accessToken);

        // Xác thực token
        $decoded = JwtHelper::verifyToken($accessToken);
        if (!$decoded) {
            Response::json(['message' => 'Access token không hợp lệ'], 401);
        }

        $account = AccountModel::findById($decoded->account_id);
        if (!$account) {
            Response::json(['message' => 'Access token không hợp lệ'], 401);
        }

        if (!$account['access_token']) {
            Response::json(['message' => 'Tài khoản đã đăng xuất'], 401);
        }

        if ($account['access_token'] !== $accessToken) {
            Response::json(['message' => 'Access token không hợp lệ'], 401);
        }

        // Lấy ID từ access token
        $id = $decoded->account_id;

        // Xóa access_token và refresh_token khỏi database
        AccountModel::updateTokens($id, null, null);
        AccountModel::deleteDeviceToken($id);

        Response::json(['message' => 'Đăng xuất thành công']);
    }

    // Kiểm tra đăng ký
    private function checkInfoRegister($name, $phone, $password)
    {
        // Kiểm tra tên tài khoản
        $nameCheck = Validator::isText($name, 'Tên tài khoản', 3, 20);
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
}
