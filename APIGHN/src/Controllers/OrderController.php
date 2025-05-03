<?php

namespace App\Controllers;

use App\Helpers\Response;
use App\Models\AddressModel;
use App\Helpers\Auth;
use App\Helpers\CallApi;
use App\Helpers\GHN;
use App\Helpers\Log;
use App\Helpers\Request;

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
    
            $hash = md5($baseString);
    
            // Tạo số ngày bắt đầu giao hàng (2 đến 3 ngày tới)
            $seedStart = hexdec(substr($hash, 0, 6));
            $daysStart = ($seedStart % 2) + 2;
    
            // Tạo khoảng chênh lệch giao hàng (1 hoặc 2 ngày)
            $seedDiff = hexdec(substr($hash, 6, 4));
            $daysDiff = ($seedDiff % 2) + 1;
    
            // Tính from & to timestamp (cuối ngày)
            $fromDate = strtotime("+$daysStart days");
            $toDate = strtotime("+".($daysStart + $daysDiff)." days");
    
            $leadtime = strtotime(date("Y-m-d 23:59:59", $toDate)); // lấy cuối khoảng
    
            return Response::json([
                "code" => 200,
                "message" => "Success",
                "data" => [
                    "leadtime" => $leadtime,
                    "leadtime_order" => [
                        "from_estimate_date" => gmdate("Y-m-d\T23:59:59\Z", $fromDate),
                        "to_estimate_date" => gmdate("Y-m-d\T23:59:59\Z", $toDate)
                    ]
                ]
            ]);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> leadtime: " . $th->getMessage());
            return Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
    
}
