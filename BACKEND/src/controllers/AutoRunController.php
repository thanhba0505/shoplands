<?php

namespace App\Controllers;

use App\Helpers\Response;
use App\Helpers\Log;
use App\Models\OrderModel;

class AutoRunController {
    // public function deleteOrdersUnpaid() {
    //     try {
    //         $i = 0;
    //         // while (true) {
    //         //     Log::autoRunDeleteOrderUnpaid("Đang chạy lần thứ " . ($i + 1) . "...\n");

    //         //     $result = OrderModel::getOrdersUnpaid();

    //         //     $i++;
    //         // }

    //         Log::autoRunDeleteOrderUnpaid("Đa hóa vòng lặp thực hiện.");
    //     } catch (\Throwable $th) {
    //         Log::throwable("AutoRunController -> deleteOrdersUnpaid: " . $th->getMessage());
    //         Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
    //     }
    // }
}
