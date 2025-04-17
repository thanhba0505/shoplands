<?php

namespace App\Controllers;

use App\Helpers\Log;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Models\OrderModel;

class WebhookController {
    public function handleUpdateStatus() {
        try {
            $status = Request::json('Status');
            $order_code = Request::json('OrderCode');

            if (!$status || !$order_code) {
                Response::json(['message' => 'Không đủ thông tin'], 400);
            }

            $order = OrderModel::findByGhnOrderCode($order_code);

            if (!$order) {
                Response::json(['message' => 'Không tìm thấy đơn hàng'], 200);
            }

            OrderModel::updateStatus($order["order_id"], $status);

            Response::json(['message' => 'Cập nhật trạng thái thành công'], 200);
        } catch (\Throwable $th) {
            Log::throwable("WebhookController -> handleUpdateStatus: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
