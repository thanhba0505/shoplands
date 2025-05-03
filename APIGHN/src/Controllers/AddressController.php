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
    // Lấy danh sách tinh thanh
    public function getProvinces() {
        try {
            $res = CallApi::get("https://open.oapi.vn/location/provinces?page=0&size=1000");

            if ($res['data']) {
                $result  = [];
                $result['code'] = 200;
                $result['message'] = 'success';

                foreach ($res['data'] as $province) {
                    $result['data'][] = [
                        'ProvinceID' => $province['id'],
                        'ProvinceName' => $province['name']
                    ];
                }

                Response::json($result);
            } else {
                Response::json(['code' => 400, 'message' => 'Không tìm thấy tỉnh/thành'], 400);
            }
        } catch (\Throwable $th) {
            Log::throwable("AddressController -> getProvinces: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy danh sách quan huyen
    public function getDistricts() {
        try {
            $province_id = Request::get('province_id');

            if ($province_id) {
                $res = CallApi::get("https://open.oapi.vn/location/districts/" . $province_id . "?page=0&size=1000");
            } else {
                $res = CallApi::get("https://open.oapi.vn/location/districts?page=0&size=1000");
            }

            if ($res['data']) {
                $result  = [];
                $result['code'] = 200;
                $result['message'] = 'success';

                foreach ($res['data'] as $district) {
                    $result['data'][] = [
                        'DistrictID' => $district['id'],
                        'DistrictName' => $district['name']
                    ];
                }

                Response::json($result);
            } else {
                Response::json(['code' => 400, 'message' => 'Không tìm thấy quận/huyện'], 400);
            }
        } catch (\Throwable $th) {
            Log::throwable("AddressController -> getDistricts: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy danh sách phuong xa
    public function getWards() {
        try {
            $district_id = Request::get('district_id');

            if ($district_id) {
                $res = CallApi::get("https://open.oapi.vn/location/wards/" . $district_id . "?page=0&size=1000");
            } else {
                $res = CallApi::get("https://open.oapi.vn/location/wards?page=0&size=1000");
            }

            if ($res['data']) {
                $result  = [];
                $result['code'] = 200;
                $result['message'] = 'success';

                foreach ($res['data'] as $ward) {
                    $result['data'][] = [
                        'WardCode' => $ward['id'],
                        'WardName' => $ward['name']
                    ];
                }

                Response::json($result);
            } else {
                Response::json(['code' => 400, 'message' => 'Không tìm thấy phường xã'], 400);
            }
        } catch (\Throwable $th) {
            Log::throwable("AddressController -> getWards: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
