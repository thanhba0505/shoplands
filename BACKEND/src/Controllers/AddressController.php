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

            AddressModel::create(
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

            Response::json(['message' => 'Thêm địa chỉ thành công'], 200);
        } catch (\Throwable $th) {
            Log::throwable("AddressController -> userAdd: " . $th->getMessage());
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
