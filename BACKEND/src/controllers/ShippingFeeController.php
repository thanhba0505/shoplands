<?php

namespace App\Controllers;

use App\Helpers\Response;
use App\Helpers\Log;
use App\Models\ShippingFeeModel;

class ShippingFeeController {
    public function getAll() {
        try {
            $shippingFees = ShippingFeeModel::getAll();

            Response::json($shippingFees);
        } catch (\Throwable $th) {
            Log::throwable("Lỗi lấy danh sách địa chỉ: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
