<?php

namespace App\Controllers;

use App\Helpers\Response;
use App\Models\AddressModel;
use App\Helpers\Auth;
use App\Helpers\CallApi;
use App\Helpers\GHN;
use App\Helpers\Log;
use App\Helpers\Request;

class AddressController {
    // Người mua lay danh sach dia chi
    public function userGet() {
        try {
            $user = Auth::user();

            $result = AddressModel::getAllByAccountId($user['account_id']);

            Response::json($result);
        } catch (\Throwable $th) {
            Log::throwable("AddressController -> userGet: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Người mua thêm địa chỉ
    public function userAdd() {
        try {
            $user = Auth::user();

            $address_line = Request::json('address_line');
            $district_id = Request::json('district_id');
            $province_id = Request::json('province_id');
            $province_name = Request::json('province_name');
            $district_name = Request::json('district_name');
            $ward_id = Request::json('ward_id');
            $ward_name = Request::json('ward_name');

            if (!$address_line || !$ward_id || !$district_id || !$province_id || !$province_name || !$district_name || !$ward_name) {
                Response::json(['message' => 'Không đủ thông tin địa chỉ'], 400);
            }

            $address = AddressModel::getAllByAccountId($user['account_id']);

            $default = 1;

            if (count($address) > 0) {
                $default = 0;
            }

            $address_id = AddressModel::create(
                $address_line,
                $default,
                $province_id,
                $province_name,
                $district_id,
                $district_name,
                $ward_id,
                $ward_name,
                $user['account_id']
            );

            $data = [
                'address_id' => $address_id,
                'address_line' => $address_line,
                'default' => $default,
                'province_id' => $province_id,
                'province_name' => $province_name,
                'district_id' => $district_id,
                'district_name' => $district_name,
                'ward_id' => $ward_id,
                'ward_name' => $ward_name,
                'account_id' => $user['account_id']
            ];

            Response::json(['message' => 'Thêm địa chỉ thành công', 'data' => $data], 200);
        } catch (\Throwable $th) {
            Log::throwable("AddressController -> userAdd: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Người mua cài đặt mặt định địa chi
    public function userUpdateDefault() {
        try {
            $address_id = Request::json('address_id');

            if (!$address_id) {
                Response::json(['message' => 'Không đủ thông tin địa chi'], 400);
            }

            $user = Auth::user();

            $result = AddressModel::setDefault($user['account_id'], $address_id);

            if (!$result) {
                Response::json(['message' => 'Cập nhật địa chỉ mặc định thất bại'], 400);
            }

            Response::json(['message' => 'Cập nhật địa chỉ mặc định thành công'], 200);
        } catch (\Throwable $th) {
            Log::throwable("AddressController -> userUpdateDefault: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Người mua xóa địa chỉ
    public function userDelete($address_id) {
        try {
            $user = Auth::user();

            $result = AddressModel::delete($user['account_id'], $address_id);

            if (!$result) {
                Response::json(['message' => 'Xóa địa chỉ thất bại'], 400);
            }

            Response::json(['message' => 'Xóa địa chỉ thành công'], 200);
        } catch (\Throwable $th) {
            Log::throwable("AddressController -> userDelete: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy địac chỉ người bán
    public function find($seller_id) {
        try {
            $result = AddressModel::getAllBySellerId($seller_id);

            if (!$result) {
                Response::json(['message' => 'Không tìm thấy người bán'], 400);
            }

            Response::json($result);
        } catch (\Throwable $th) {
            Log::throwable("AddressController -> find: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy danh sách tinh thanh
    public function getProvinces() {
        try {
            $res = GHN::getProvinces();

            // Lọc provinceID từ 201 đến 269
            // $res['data'] = array_filter($res['data'], function ($province) {
            //     return $province['ProvinceID'] >= 201 && $province['ProvinceID'] <= 269;
            // });

            // // Re-index lại mảng để tránh có chỉ mục bị bỏ trống
            // $res['data'] = array_values($res['data']);

            // Trả lại kết quả sau khi đã lọc
            Response::json($res);
        } catch (\Throwable $th) {
            Log::throwable("AddressController -> getProvinces: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy danh sách quan huyen
    public function getDistricts() {
        try {
            $province_id = Request::get('province_id');

            $res = GHN::getDistricts($province_id);

            // $res['data'] = array_filter($res['data'], function ($district) {
            //     return !in_array($district['DistrictID'], [3451]);
            // });

            // $res['data'] = array_values($res['data']);

            Response::json($res);
        } catch (\Throwable $th) {
            Log::throwable("AddressController -> getDistricts: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy danh sách phuong xa
    public function getWards() {
        try {
            $district_id = Request::get('district_id');

            if (!$district_id) {
                Response::json(['message' => 'Không tìm thấy mã quận/huyện'], 400);
            }

            $res = GHN::getWards($district_id);

            Response::json($res);
        } catch (\Throwable $th) {
            Log::throwable("AddressController -> getWards: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
