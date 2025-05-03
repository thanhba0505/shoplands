<?php

namespace App\Controllers;

use App\Helpers\CallApi;
use App\Helpers\Response;
use App\Helpers\Log;
use App\Helpers\Request;
use App\Models\GHNModel;

class OrderController {
    // Giả sử tạo đơn hàng
    public function preview() {
        try {
            Response::json(['code' => 200]);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> preview: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Tính phí dịch vụ
    public function fee() {
        try {
            $service_type_id = Request::json('service_type_id');
            $from_district_id = Request::json('from_district_id');
            $from_ward_code = Request::json('from_ward_code');
            $to_district_id = Request::json('to_district_id');
            $to_ward_code = Request::json('to_ward_code');
            $length = Request::json('length');
            $width = Request::json('width');
            $height = Request::json('height');
            $weight = Request::json('weight');

            $fee = $this->calculateFee(
                $service_type_id,
                $from_district_id,
                $from_ward_code,
                $to_district_id,
                $to_ward_code,
                $length,
                $width,
                $height,
                $weight
            );

            return Response::json($fee);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> fee: " . $th->getMessage());
            return Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Tính phí
    private function calculateFee(
        $service_type_id,
        $from_district_id,
        $from_ward_code,
        $to_district_id,
        $to_ward_code,
        $length,
        $width,
        $height,
        $weight
    ) {
        // Ghép tất cả input lại thành chuỗi ổn định
        $inputString = implode('-', [
            $service_type_id,
            $from_district_id,
            $from_ward_code,
            $to_district_id,
            $to_ward_code,
            $length,
            $width,
            $height,
            $weight
        ]);

        // Băm chuỗi đầu vào
        $hash = md5($inputString);
        $seed = hexdec(substr($hash, 0, 8)); // Lấy 8 ký tự đầu tiên làm số

        // Map seed thành số từ 15000 đến 50000 (làm tròn đến hàng nghìn)
        $total = round((15000 + ($seed % 35001)) / 1000) * 1000;

        return [
            "code" => 200,
            "message" => "Success",
            "data" => [
                "total" => $total,
                "service_fee" => $total,
                "insurance_fee" => 0,
                "pick_station_fee" => 0,
                "coupon_value" => 0,
                "r2s_fee" => 0,
                "return_again" => 0,
                "document_return" => 0,
                "double_check" => 0,
                "cod_fee" => 0,
                "pick_remote_areas_fee" => 0,
                "deliver_remote_areas_fee" => 0,
                "cod_failed_fee" => 0
            ]
        ];
    }

    // Tính thời gian dự kiến
    public function leadtime() {
        try {
            $from_district_id = Request::json('from_district_id');
            $from_ward_code = Request::json('from_ward_code');
            $to_district_id = Request::json('to_district_id');
            $to_ward_code = Request::json('to_ward_code');
            $service_id = Request::json('service_id');

            $leadtime = $this->calculateLeadtime(
                $from_district_id,
                $from_ward_code,
                $to_district_id,
                $to_ward_code,
                $service_id
            );

            return Response::json([
                "code" => 200,
                "message" => "Success",
                "data" => [
                    "leadtime_order" => [
                        "from_estimate_date" => $leadtime['fromDate'],
                        "to_estimate_date" => $leadtime['toDate']
                    ]
                ]
            ]);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> leadtime: " . $th->getMessage());
            return Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Tính thời gian
    private function calculateLeadtime(
        $from_district_id,
        $from_ward_code,
        $to_district_id,
        $to_ward_code,
        $service_id
    ) {
        // Ngày hiện tại để cố định theo ngày gọi
        $today = date('Ymd');

        // Ghép đầu vào + ngày để sinh hash ổn định mỗi ngày
        $baseString = implode('-', [
            $from_district_id,
            $from_ward_code,
            $to_district_id,
            $to_ward_code,
            $service_id,
            $today
        ]);

        // Băm chuỗi đầu vào
        $hash = md5($baseString);

        // Tạo số ngày bắt đầu giao hàng (2 đến 3 ngày tới)
        $seedStart = hexdec(substr($hash, 0, 6));
        $daysStart = ($seedStart % 2) + 2;

        // Tạo khoảng chênh lệch giao hàng (1 hoặc 2 ngày)
        $seedDiff = hexdec(substr($hash, 6, 4));
        $daysDiff = ($seedDiff % 2) + 1;

        // Tính ngày từ và ngày đến
        $fromDate = strtotime("+$daysStart days");
        $toDate = strtotime("+" . ($daysStart + $daysDiff) . " days");

        return [
            'fromDate' => gmdate("Y-m-d\T23:59:59\Z", $fromDate),
            'toDate' => gmdate("Y-m-d\T23:59:59\Z", $toDate)
        ];
    }


    // Tạo đơn hàng
    public function create() {
        try {
            $from_name = Request::json('from_name');
            $from_phone = Request::json('from_phone');
            $from_address = Request::json('from_address');
            $from_ward_name = Request::json('from_ward_name');
            $from_district_name = Request::json('from_district_name');
            $from_province_name = Request::json('from_province_name');

            $to_name = Request::json('to_name');
            $to_phone = Request::json('to_phone');
            $to_address = Request::json('to_address');
            $to_ward_name = Request::json('to_ward_name');
            $to_district_name = Request::json('to_district_name');
            $to_province_name = Request::json('to_province_name');

            // Lấy id tinh, quan, xa bên người gửi
            $from_province = CallApi::get(
                "https://open.oapi.vn/location/provinces?page=0&size=1000&query=" . $from_province_name
            );

            if (!$from_province || $from_province['total'] == 0) {
                Response::json(['message' => 'Không tìm thấy tỉnh/thành phố nơi gửi'], 400);
            }

            $from_district = CallApi::get(
                "https://open.oapi.vn/location/districts/" . $from_province['data'][0]['id'] . "?page=0&size=1000&query=" . $from_district_name
            );

            if (!$from_district || $from_district['total'] == 0) {
                Response::json(['message' => 'Không tìm thấy quận/huyện nơi gửi'], 400);
            }

            $from_ward = CallApi::get(
                "https://open.oapi.vn/location/wards/" . $from_district['data'][0]['id'] . "?page=0&size=1000&query=" . $from_ward_name
            );

            if (!$from_ward || $from_ward['total'] == 0) {
                Response::json(['message' => 'Không tìm thấy phường/xã nơi gửi'], 400);
            }

            // Lấy id tinh, quan, xa bên người nận
            $to_province = CallApi::get(
                "https://open.oapi.vn/location/provinces?page=0&size=1000&query=" . $to_province_name
            );

            if (!$to_province || $to_province['total'] == 0) {
                Response::json(['message' => 'Không tìm thấy tỉnh/thành phố nơi gửi'], 400);
            }

            $to_district = CallApi::get(
                "https://open.oapi.vn/location/districts/" . $to_province['data'][0]['id'] . "?page=0&size=1000&query=" . $to_district_name
            );

            if (!$to_district || $to_district['total'] == 0) {
                Response::json(['message' => 'Không tìm thấy quận/huyện nơi gửi'], 400);
            }

            $to_ward = CallApi::get(
                "https://open.oapi.vn/location/wards/" . $to_district['data'][0]['id'] . "?page=0&size=1000&query=" . $to_ward_name
            );

            if (!$to_ward || $to_ward['total'] == 0) {
                Response::json(['message' => 'Không tìm thấy phường/xã nơi gửi'], 400);
            }
            
            $from_district_id = $from_district['data'][0]['id'];
            $from_ward_code = $from_ward['data'][0]['id'];
            $to_district_id = $to_district['data'][0]['id'];
            $to_ward_code = $to_ward['data'][0]['id'];
            $service_id = 53320;

            $leadtime = $this->calculateLeadtime(
                $from_district_id,
                $from_ward_code,
                $to_district_id,
                $to_ward_code,
                $service_id
            );  

            $order_code = uniqid();
            
            GHNModel::insertOrder(
                $from_name,
                $from_phone,
                $from_address,
                $from_ward_name,
                $from_district_name,
                $from_province_name,
                $to_name,
                $to_phone,
                $to_address,
                $to_ward_name,
                $to_district_name,
                $to_province_name,
                $order_code,
                $leadtime['fromDate'],
                $leadtime['toDate']
            );
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> createOrder: " . $th->getMessage());
            return Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
