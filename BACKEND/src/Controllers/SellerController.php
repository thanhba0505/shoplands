<?php

namespace App\Controllers;

use App\Helpers\FileSave;
use App\Helpers\Response;
use App\Helpers\Log;
use App\Helpers\Request;
use App\Helpers\Validator;
use App\Models\AccountModel;
use App\Models\AddressModel;
use App\Models\SellerModel;

class SellerController {
    // Tìm kiếm người bán
    public function find($seller_id) {
        try {
            $seller = SellerModel::findBySellerId($seller_id);

            if (!$seller) {
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
    public function register() {
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
                Response::json(['message' => 'Số điện thoại có tài khoản'], 400);
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

            $backgroundUpload = FileSave::avatarImage($backgroundFile);
            if ($backgroundUpload['success'] == false) {
                Response::json(['message' => $backgroundUpload['message']], 400);
            }

            $accountId = AccountModel::addAccountSeller($phone, $password, $bank_name, $bank_number);
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

            Response::json([
                'message' => 'Đăng ký người bán thành công, vui lòng chờ quản trị viên xác nhận trong 2-3 ngày'
            ], 201);
        } catch (\Throwable $th) {
            Log::throwable("SellerController -> register: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Xử lý đăng ký người bán
    public function adminHandleRegister() {
        try {
            $seller_id = Request::json('seller_id');
            $accept = Request::json('accept');

            $seller = SellerModel::findBySellerId($seller_id);

            if (!$seller) {
                Response::json(['message' => 'Không tìm thấy người bán'], 400);
            }

            if ($seller['status'] === 'active') {
                Response::json(['message' => 'Người bán đã hoạt động'], 400);
            }

            if ($accept) {
                AccountModel::activeAccount($seller['account_id']);
                Response::json([
                    'message' => 'Đã duyệt người bán'
                ]);
            }

            SellerModel::delete($seller_id);
            AddressModel::delete($seller['account_id']);
            AccountModel::delete($seller['account_id']);

            Response::json([
                'message' => 'Đã từ chối người bán'
            ]);
        } catch (\Throwable $th) {
            Log::throwable("SellerController -> adminHandleRegister: " . $th->getMessage());
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

        $checkStoreName = Validator::isText($store_name, 'Tên cửa hàng', 3, 100);
        if ($checkStoreName !== true) {
            Response::json(['message' => $checkStoreName], 400);
        }

        $checkOwnerName = Validator::isText($owner_name, 'Tên chủ chửa hàng', 3, 100);
        if ($checkOwnerName !== true) {
            Response::json(['message' => $checkOwnerName], 400);
        }

        $checkDescription = Validator::isText($description, 'Mô tả', 3, 10000, true);
        if ($checkDescription !== true) {
            Response::json(['message' => $checkDescription], 400);
        }

        $checkBankNumber = Validator::isText($bank_number, 'Số tài khoản', 6, 30);
        if ($checkBankNumber !== true) {
            Response::json(['message' => $checkBankNumber], 400);
        }

        $checkBankName = Validator::isText($bank_name, 'Tên ngân hàng', 1, 100);
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
}
