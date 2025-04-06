<?php

namespace App\Controllers;

use App\Helpers\Response;
use App\Helpers\Log;
use App\Models\SellerModel;

class SellerController {
    public function find($seller_id) {
        try {
            $seller = SellerModel::findBySellerId($seller_id);

            if (!$seller) {
                Response::json(['message' => 'Không tìm thấy thông tin'], 400);
            }

            unset($seller['coin']);
            unset($seller['bank_number']);
            unset($seller['bank_name']);

            Response::json($seller);
        } catch (\Throwable $th) {
            Log::throwable("SellerController -> find: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
