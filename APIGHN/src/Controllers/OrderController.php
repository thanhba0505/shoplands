<?php

namespace App\Controllers;

use App\Helpers\CallApi;
use App\Helpers\Format;
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
            $from_name = Request::json('from_name') ?? Request::post('from_name');
            $from_phone = Request::json('from_phone') ?? Request::post('from_phone');
            $from_address = Request::json('from_address') ?? Request::post('from_address');
            $from_ward_name = Request::json('from_ward_name') ?? Request::post('from_ward_name');
            $from_district_name = Request::json('from_district_name') ?? Request::post('from_district_name');
            $from_province_name = Request::json('from_province_name') ?? Request::post('from_province_name');

            $to_name = Request::json('to_name') ?? Request::post('to_name');
            $to_phone = Request::json('to_phone') ?? Request::post('to_phone');
            $to_address = Request::json('to_address') ?? Request::post('to_address');
            $to_ward_name = Request::json('to_ward_name') ?? Request::post('to_ward_name');
            $to_district_name = Request::json('to_district_name') ?? Request::post('to_district_name');
            $to_province_name = Request::json('to_province_name') ?? Request::post('to_province_name');

            if (
                !$from_name ||
                !$from_phone ||
                !$from_address ||
                !$from_ward_name ||
                !$from_district_name ||
                !$from_province_name ||
                !$to_name ||
                !$to_phone ||
                !$to_address ||
                !$to_ward_name ||
                !$to_district_name ||
                !$to_province_name
            ) {
                Response::json(['message' => 'Thông tin dữ liệu không hợp lệ'], 400);
            }

            // Lấy id tinh, quan, xa bên người gửi
            $from_province = CallApi::get(
                "https://open.oapi.vn/location/provinces?page=0&size=1000&query=" . $from_province_name
            )['response'];

            if (!$from_province || $from_province['total'] == 0) {
                Response::json(['message' => 'Không tìm thấy tỉnh/thành phố nơi gửi'], 400);
            }

            $from_district = CallApi::get(
                "https://open.oapi.vn/location/districts/" . $from_province['data'][0]['id'] . "?page=0&size=1000&query=" . $from_district_name
            )['response'];

            if (!$from_district || $from_district['total'] == 0) {
                Response::json(['message' => 'Không tìm thấy quận/huyện nơi gửi'], 400);
            }

            $from_ward = CallApi::get(
                "https://open.oapi.vn/location/wards/" . $from_district['data'][0]['id'] . "?page=0&size=1000&query=" . $from_ward_name
            )['response'];

            if (!$from_ward || $from_ward['total'] == 0) {
                Response::json(['message' => 'Không tìm thấy phường/xã nơi gửi'], 400);
            }

            // Lấy id tinh, quan, xa bên người nận
            $to_province = CallApi::get(
                "https://open.oapi.vn/location/provinces?page=0&size=1000&query=" . $to_province_name
            )['response'];

            if (!$to_province || $to_province['total'] == 0) {
                Response::json(['message' => 'Không tìm thấy tỉnh/thành phố nơi gửi'], 400);
            }

            $to_district = CallApi::get(
                "https://open.oapi.vn/location/districts/" . $to_province['data'][0]['id'] . "?page=0&size=1000&query=" . $to_district_name
            )['response'];

            if (!$to_district || $to_district['total'] == 0) {
                Response::json(['message' => 'Không tìm thấy quận/huyện nơi gửi'], 400);
            }

            $to_ward = CallApi::get(
                "https://open.oapi.vn/location/wards/" . $to_district['data'][0]['id'] . "?page=0&size=1000&query=" . $to_ward_name
            )['response'];

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
                $from_ward['data'][0]['name'],
                $from_district['data'][0]['name'],
                $from_province['data'][0]['name'],
                $to_name,
                $to_phone,
                $to_address,
                $to_ward['data'][0]['name'],
                $to_district['data'][0]['name'],
                $to_province['data'][0]['name'],
                $order_code,
                $leadtime['fromDate'],
                $leadtime['toDate']
            );

            GHNModel::insertStatus(
                $order_code,
                "ready_to_pick",
                Format::getOrderStatusInVie("ready_to_pick")
            );

            Response::json([
                "code" => 200,
                "message" => "Success",
                "data" => [
                    "order_code" => $order_code
                ]
            ]);
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> create: " . $th->getMessage());
            return Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Cập nhật trạng thái cho 1 đơn hàng
    public function status() {
        try {
            $order_code = Request::post('order_code');
            $status = Request::post('status');

            if (!$order_code || !$status) {
                $this->viewAddStatus();
            } else {
                $order = GHNModel::find($order_code);

                if (!$order) {
                    $this->viewAddStatus("Không tìm thấy đơn hàng");
                }

                $last_status = GHNModel::getLastStatus($order_code);

                $valid_transitions = $this->getValidTransitions($last_status['status']);

                if (!in_array($status, $valid_transitions)) {
                    $this->viewAddStatus(
                        "Không thể chuyển trạng thái từ " .
                            $last_status['status'] .
                            " sang " . $status
                    );
                }

                GHNModel::insertStatus(
                    $order_code,
                    $status,
                    Format::getOrderStatusInVie($status)
                );

                // Gọi webhook
                $result = CallApi::post(
                    $_ENV['FRONTEND_URL'] . '/api/update-status',
                    [
                        'order_code' => $order_code,
                        'status' => $status
                    ]
                );

                Log::global($result);

                $this->viewAddStatus("Cập nhật trạng thái thành công");
            }
        } catch (\Throwable $th) {
            Log::throwable("OrderController -> addStatus: " . $th->getMessage());
            return Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // View add status
    private function viewAddStatus($message = null) {
        // Lấy tất cả trạng thái từ hàm getAllStatus
        $statuses = $this->getAllStatus();

        // Thêm CSS để tạo giao diện đẹp hơn
        echo '<style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f7fc;
                padding: 20px;
            }
            form {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                max-width: 500px;
                margin: 0 auto;
            }
            h2 {
                text-align: center;
                color: #333;
            }
            .form-group {
                margin-bottom: 15px;
            }
            label {
                font-size: 14px;
                color: #555;
                margin-bottom: 5px;
                display: block;
            }
            input[type="text"], select {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 14px;
                color: #333;
            }
            button {
                width: 100%;
                padding: 12px;
                background-color: #007bff;
                border: none;
                color: #fff;
                font-size: 16px;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }
            button:hover {
                background-color: #0056b3;
            }
            .error-message {
                color: red;
                text-align: center;
                margin-top: 10px;
                margin-bottom: 10px;
                font-size: 14px;
            }
        </style>';

        // Bắt đầu form
        echo '<form action="" method="POST">
                <h2>Cập nhật trạng thái đơn hàng</h2>
                <div class="form-group">
                    <label for="order_code">Mã đơn hàng:</label>
                    <input type="text" id="order_code" name="order_code" value="' .
            ((isset($_POST['order_code']) ? $_POST['order_code'] : '')) . '" required>
                </div>
                <div class="form-group">
                    <label for="status">Chọn trạng thái:</label>
                    <select id="status" name="status" required>';

        // Duyệt qua tất cả trạng thái và tạo các options
        foreach ($statuses as $key => $value) {
            echo "<option value=\"$key\">$key --- $value</option>";
        }

        echo '  </select>
                </div>';

        // Hiển thị thông báo nếu có
        if ($message) {
            echo '<div class="error-message">' . $message . '</div>';
        }

        echo '  <div>
                    <button type="submit">Cập nhật trạng thái</button>
                </div>
            </form>';

        echo '<div style="text-align: center; margin-top: 30px;">
                <img src="' . BASE_URL . '/src/Storage/status-ghn.jpeg" alt="status">
            </div>';

        exit();
    }


    // Tất cả trạng thái
    private function getAllStatus() {
        return [
            "ready_to_pick" => "Mới tạo đơn hàng",
            "picking" => "Nhân viên đang lấy hàng",
            "cancel" => "Hủy đơn hàng",
            "picked" => "Nhân viên đã lấy hàng",
            "storing" => " Hàng đang nằm ở kho",
            "transporting" => "Đang luân chuyển hàng",
            "delivering" => "Nhân viên đang giao cho người nhận",
            "delivered" => "Nhân viên đã giao hàng thành công",
            "delivery_fail" => " Nhân viên giao hàng thất bại",
            "waiting_to_return" => "Đang đợi trả hàng về cho người gửi",
            "return" => "Trả hàng",
            "return_transporting" => "Đang luân chuyển hàng trả",
            "returning" => "Nhân viên đang đi trả hàng",
            "return_fail" => "Nhân viên trả hàng thất bại",
            "returned" => "Nhân viên trả hàng thành công",
            "damage" => "Hàng bị hư hỏng",
            "lost" => "Hàng bị mất",
        ];
    }

    // Lấy trạng thái hợp lý
    private function getValidTransitions($currentStatus) {
        $transitions = [
            "ready_to_pick" => ["picking", "cancel", "storing"],
            "picking" => ["picked", "cancel", "ready_to_pick"],
            "cancel" => [],
            "picked" => ["delivering", "return", "storing", "damage", "lost"],
            "storing" => ["delivering", "delivered", "return", "transporting", "damage", "lost"],
            "transporting" => ["storing", "delivered", "delivering", "damage", "lost"],
            "delivering" => ["delivered", "delivery_fail"],
            "delivered" => [],
            "delivery_fail" => ["delivering", "storing", "waiting_to_return", "damage", "lost"],
            "waiting_to_return" => ["storing", "return"],
            "return" => ["return_transporting", "returning", "returned", "damage", "lost"],
            "return_transporting" => ["returning", "return", "damage", "lost"],
            "returning" => ["returned", "return_fail"],
            "return_fail" => ["returning", "return", "damage", "lost"],
            "returned" => [],
            "damage" => [],
            "lost" => [],
        ];

        return $transitions[$currentStatus] ?? [];
    }
}
