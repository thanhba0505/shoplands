<?php

namespace App\Controllers;

use App\Helpers\GHN;
use App\Helpers\Response;
use App\Helpers\Log;
use App\Models\OrderModel;

class AutoRunController {
    public function updateStatusOrder() {
        try {
            $ghnOrders = OrderModel::getDeliveredOrders();

            foreach ($ghnOrders as $ghnOrder) {
                $result = GHN::getOrder($ghnOrder['ghn_order_code']);

                if ($ghnOrder['current_status'] !== $result["data"]["status"]) {
                    OrderModel::updateStatus($ghnOrder['order_id'], $result["data"]["status"]);
                    Log::autoRunUpdateOrder(
                        "Đơn hàng #" . $ghnOrder['order_id'] . ": " .
                            $ghnOrder['current_status'] . " -> " . $result["data"]["status"]
                    );
                }
            }

            Response::json(['message' => 'Cập nhật trạng thái đơn hàng thành công'], 200);
        } catch (\Throwable $th) {
            Log::throwable("AutoRunController -> updateStatusOrder: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
