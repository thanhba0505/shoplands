<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\FileSave;
use App\Helpers\Hash;
use App\Helpers\Response;
use App\Helpers\Log;
use App\Helpers\Request;
use App\Helpers\SendMessage;
use App\Helpers\Validator;
use App\Models\AccountModel;
use App\Models\AddressModel;
use App\Models\MessageModel;
use App\Models\SellerModel;

class SellerController {
    // Tìm kiếm người bán
    public function find($seller_id) {
        try {
            $seller = SellerModel::findBySellerId($seller_id);

            if (!$seller || !$seller['seller_id']) {
                Response::json(['message' => 'Không tìm thấy thông tin'], 400);
            }

            unset($seller['coin']);
            unset($seller['bank_number']);
            unset($seller['bank_name']);

            Response::json($seller);
        } catch (\Throwable $th) {
            Log::throwable("SellerController -> find: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Tìm kiếm người bán
    public function sellerFind() {
        try {
            $seller = Auth::seller();
            $seller = SellerModel::findBySellerId($seller['seller_id']);

            if (!$seller || !$seller['seller_id']) {
                Response::json(['message' => 'Không tìm thấy thông tin'], 400);
            }

            Response::json($seller);
        } catch (\Throwable $th) {
            Log::throwable("SellerController -> find: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Admin lấy danh sách người bán
    public function adminGet() {
        try {
            $status = Request::get('status') && Request::get('status') != "all" ? Request::get('status') : "";
            $limit = Request::get('limit', 12);
            $page = Request::get('page', 0);

            $count = SellerModel::countByStatus($status == "all" ? null : $status);
            $sellers = SellerModel::getAll($status, $limit, $page);

            $result = [
                "count" => $count,
                "sellers" => $sellers
            ];

            Response::json($result);
        } catch (\Throwable $th) {
            Log::throwable("SellerController -> adminGet: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Đăng ký người bán
    public function getCodeRegister() {
        try {
            $store_name = Request::post('store_name');
            $owner_name = Request::post('owner_name');
            $description = Request::post('description');
            $phone = Request::post('phone');
            $password = Request::post('password');
            $bank_number = Request::post('bank_number');
            $bank_name = Request::post('bank_name');
            $logoFile = Request::file('logo');
            $backgroundFile = Request::file('background');

            $address_line = Request::post('address_line');
            $district_id = Request::post('district_id');
            $province_id = Request::post('province_id');
            $province_name = Request::post('province_name');
            $district_name = Request::post('district_name');
            $ward_id = Request::post('ward_id');
            $ward_name = Request::post('ward_name');

            // Kiểm tra phone
            $checkPhone = Validator::isPhone($phone);
            if ($checkPhone !== true) {
                Response::json(['message' => $checkPhone], 400);
            }

            $account = AccountModel::findByPhone($phone);
            if ($account) {
                if ($account['role'] === 'seller' && $account['status'] === 'inactive') {
                    Response::json(['message' => 'Số điện thoại đã đăng ký và chờ duyệt'], 400);
                }
                if ($account['role'] === 'seller' && $account['status'] === 'unverified') {
                    $result = SendMessage::sendMessageCode($phone, $account['account_id']);

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
                }
                Response::json(['message' => 'Số  thoại đã có tài khoản'], 400);
            }

            $this->validateRegister(
                $store_name,
                $owner_name,
                $description,
                $password,
                $bank_number,
                $bank_name,
                $logoFile,
                $backgroundFile
            );

            $this->validateAddress(
                $address_line,
                $district_id,
                $province_id,
                $province_name,
                $district_name,
                $ward_id,
                $ward_name
            );

            $logoUpload = FileSave::avatarImage($logoFile);
            if ($logoUpload['success'] == false) {
                Response::json(['message' => $logoUpload['message']], 400);
            }

            $backgroundUpload = FileSave::backgroundImage($backgroundFile);
            if ($backgroundUpload['success'] == false) {
                Response::json(['message' => $backgroundUpload['message']], 400);
            }

            $accountId = AccountModel::addAccountSeller(
                $phone,
                $password,
                $bank_name,
                $bank_number,
                'seller',
                'unverified'
            );

            SellerModel::add(
                $store_name,
                $owner_name,
                $description,
                $logoUpload['file_name'],
                $backgroundUpload['file_name'],
                $accountId
            );

            AddressModel::create(
                $address_line,
                1,
                $province_id,
                $province_name,
                $district_id,
                $district_name,
                $ward_id,
                $ward_name,
                $accountId
            );

            $result = SendMessage::sendMessageCode($phone, $accountId);

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
            Log::throwable("SellerController -> register: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Xác thực code đăng ký
    public function register() {
        try {
            $code = Request::json('code');
            $phone = Request::json('phone');
            $password = Request::json('password');

            $account = AccountModel::findByPhone($phone);
            if (!$account) {
                Response::json(['message' => 'Không tìm thấy tài khoản'], 400);
            }

            if ($account['status'] !== 'unverified') {
                Response::json(['message' => 'Tài khoản không hợp lệ'], 400);
            }

            if (!Hash::verifyArgon2i($password, $account['password'])) {
                Response::json(['message' => 'Mật khẩu không đúng'], 400);
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

            AccountModel::updateStatus(
                $account['account_id'],
                'inactive'
            );

            Response::json(['message' => 'Xác thực thành công, vui lòng chờ duyệt trong 2-3 ngày'], 200);
        } catch (\Throwable $th) {
            Log::throwable("SellerController -> verifyCode: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Xử lý đăng ký người bán
    public function adminHandleRegister() {
        try {
            $seller_id = Request::json('seller_id');
            $accept = Request::json('accept');
            $reason = Request::json('reason');

            $seller = SellerModel::findBySellerId($seller_id);

            if (!$seller) {
                Response::json(['message' => 'Không tìm thấy người bán'], 400);
            }

            if ($seller['status'] === 'active') {
                Response::json(['message' => 'Người bán đã hoạt động'], 400);
            }

            if ($accept) {
                AccountModel::activeAccount($seller['account_id']);

                // Send sms
                $mess = "Cửa hàng '$seller[store_name]' đã được duyệt";

                SendMessage::send(
                    $seller['phone'],
                    $reason ? $reason : $mess
                );

                Response::json([
                    'message' => "Đã duyệt người bán '$seller[store_name]'",
                ]);
            }

            AddressModel::deleteAll($seller['account_id']);
            SellerModel::delete($seller_id);
            MessageModel::deleteAllMessage($seller['account_id']);
            AccountModel::delete($seller['account_id']);

            // Send sms
            $mess = "Cửa hàng '$seller[store_name]' đã đã bị từ chối bán hàng";

            SendMessage::send(
                $seller['phone'],
                $reason ? $reason : $mess
            );

            Response::json([
                'message' => "Đã từ chối người bán '$seller[store_name]'",
            ]);
        } catch (\Throwable $th) {
            Log::throwable("SellerController -> adminHandleRegister: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Xử lý khóa người bán
    public function adminHandleLocked() {
        try {
            $seller_id = Request::json('seller_id');
            $locked = Request::json('locked');
            $reason = Request::json('reason');
            $reason = Request::json('reason');

            $seller = SellerModel::findBySellerId($seller_id);

            if (!$seller) {
                Response::json(['message' => 'Không tìm thấy người bán'], 400);
            }

            if ($seller['status'] === 'inactive') {
                Response::json(['message' => 'Người bán chưa hoạt động'], 400);
            }

            if ($seller['status'] === 'unverified') {
                Response::json(['message' => 'Người bán chưa xác thực'], 400);
            }

            if ($locked) {
                AccountModel::lockedAccount($seller['account_id']);

                // Send sms
                $mess = "Cửa hàng '$seller[store_name]' đã bị khóa";

                SendMessage::send(
                    $seller['phone'],
                    $reason ? $reason : $mess
                );

                Response::json([
                    'message' => "Đã khóa người bán '$seller[store_name]'",
                ]);
            } else {
                AccountModel::unlockAccount($seller['account_id']);

                // Send sms
                $mess = "Cửa hàng '$seller[store_name]' đã được mở khóa";

                SendMessage::send(
                    $seller['phone'],
                    $reason ? $reason : $mess
                );

                Response::json([
                    'message' => "Đã mở khóa người bán '$seller[store_name]'",
                ]);
            }
        } catch (\Throwable $th) {
            Log::throwable("SellerController -> adminHandleLocked: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    private function validateRegister(
        $store_name,
        $owner_name,
        $description,
        $password,
        $bank_number,
        $bank_name,
        $logoFile,
        $backgroundFile
    ) {
        $checkPassword = Validator::isPasswordStrength($password);
        if ($checkPassword !== true) {
            Response::json(['message' => $checkPassword], 400);
        }

        $checkStoreName = Validator::isName($store_name, 'Tên cửa hàng', 3, 100);
        if ($checkStoreName !== true) {
            Response::json(['message' => $checkStoreName], 400);
        }

        $checkOwnerName = Validator::isName($owner_name, 'Tên chủ chửa hàng', 3, 100);
        if ($checkOwnerName !== true) {
            Response::json(['message' => $checkOwnerName], 400);
        }

        $checkDescription = Validator::isText($description, 'Mô tả', 3, 10000, true);
        if ($checkDescription !== true) {
            Response::json(['message' => $checkDescription], 400);
        }

        $checkBankNumber = Validator::isBankAccountNumber($bank_number, 'Số tài khoản', 6, 30);
        if ($checkBankNumber !== true) {
            Response::json(['message' => $checkBankNumber], 400);
        }

        $checkBankName = Validator::isName($bank_name, 'Tên ngân hàng', 1, 100);
        if ($checkBankName !== true) {
            Response::json(['message' => $checkBankName], 400);
        }

        if (!$logoFile) {
            Response::json(['message' => 'Logo cửa hàng là bắt buộc'], 400);
        }

        if (!$backgroundFile) {
            Response::json(['message' => 'Background cửa hàng là bắt buộc'], 400);
        }
    }

    private function validateAddress(
        $address_line,
        $district_id,
        $province_id,
        $province_name,
        $district_name,
        $ward_id,
        $ward_name
    ) {
        if (!$address_line || !$ward_id || !$district_id || !$province_id || !$province_name || !$district_name || !$ward_name) {
            Response::json(['message' => 'Không đủ thông tin địa chỉ'], 400);
        }
    }

    // Cập nhật avatar
    public function uploadAvatar() {
        try {
            $seller = Auth::seller();

            $logo = Request::file('logo');

            if (!$logo) {
                Response::json(['message' => 'Không tìm thấy ảnh'], 400);
            }

            $logoUpload = FileSave::avatarImage($logo);
            if ($logoUpload['success'] == false) {
                Response::json(['message' => $logoUpload['message']], 400);
            }

            SellerModel::updateLogo($seller['seller_id'], $logoUpload['file_name']);

            Response::json([
                'message' => 'Cập nhật logo thành công',
                'logo' => $logoUpload['file_name']
            ], 200);
        } catch (\Throwable $th) {
            Log::throwable("SellerController -> uploadAvatar: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Cập nhật background
    public function uploadBackground() {
        try {
            $seller = Auth::seller();

            $background = Request::file('background');

            if (!$background) {
                Response::json(['message' => 'Không tìm thấy ảnh'], 400);
            }

            $backgroundUpload = FileSave::backgroundImage($background);
            if ($backgroundUpload['success'] == false) {
                Response::json(['message' => $backgroundUpload['message']], 400);
            }

            SellerModel::updateBackground($seller['seller_id'], $backgroundUpload['file_name']);

            Response::json([
                'message' => 'Cập nhật background thành công',
                'background' => $backgroundUpload['file_name']
            ], 200);
        } catch (\Throwable $th) {
            Log::throwable("SellerController -> uploadBackground: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Cập nhật 
    public function sellerUpdate() {
        try {
            $seller = Auth::seller();

            $bank_number = Request::json('bank_number');
            $bank_name = Request::json('bank_name');
            $owner_name = Request::json('owner_name');
            $description = Request::json('description');

            $checkOwnerName = Validator::isName($owner_name, 'Tên chủ cửa hàng', 1, 100);
            if ($checkOwnerName !== true) {
                Response::json(['message' => $checkOwnerName], 400);
            }

            $checkDescription = Validator::isText($description, 'Mô tả', 3, 10000, true);
            if ($checkDescription !== true) {
                Response::json(['message' => $checkDescription], 400);
            }

            $checkBankNumber = Validator::isBankAccountNumber($bank_number, 'Số tài khoản', 6, 30);
            if ($checkBankNumber !== true) {
                Response::json(['message' => $checkBankNumber], 400);
            }

            $checkBankName = Validator::isName($bank_name, 'Tên ngân hàng', 1, 100);
            if ($checkBankName !== true) {
                Response::json(['message' => $checkBankName], 400);
            }

            if ($owner_name || $description) {
                SellerModel::updateOwnerAndDescription(
                    $seller['seller_id'],
                    $owner_name,
                    $description
                );
            }

            if ($bank_number || $bank_name) {
                AccountModel::updateBank(
                    $seller['account_id'],
                    $bank_name,
                    $bank_number
                );
            }

            Response::json([
                'message' => 'Cập nhật tài khoản ngân hàng thành công'
            ], 200);
        } catch (\Throwable $th) {
            Log::throwable("SellerController -> sellerUpdate: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
