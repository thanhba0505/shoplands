<?php

namespace App\Controllers;

use App\Helpers\Log;
use App\Helpers\Response;
use App\Models\CouponModel;

class CouponController {
    public function get($seller_id) {
        try {
            if (!$seller_id) {
                Response::json(['message' => "Mã người bán rỗng"]);
            }

            $result = CouponModel::getAll($seller_id);

            Response::json($result);
        } catch (\Throwable $th) {
            Log::throwable("CouponController -> get: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
