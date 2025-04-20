<?php

namespace App\Controllers;

use App\Helpers\Response;
use App\Helpers\Log;
use App\Helpers\Request;
use App\Models\SellerModel;

class SellerController {
    // Tìm kiếm người bán
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

    // Admin lấy danh sách người bán
    public function adminGet() {
        try {
            $status = Request::get('status') && Request::get('status') != "all" ? Request::get('status') : "";
            $limit = Request::get('limit', 12);
            $page = Request::get('page', 0);

            $count = SellerModel::countByStatus($status == "all" ? null : $status);
            $sellers = SellerModel::getAll($status, $limit, $page);

            $result = [
                "count" => $count,
                "sellers" => $sellers
            ];

            Response::json($result);
        } catch (\Throwable $th) {
            Log::throwable("SellerController -> adminGet: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Đăng ký người bán
    public function register() {
        try {
        } catch (\Throwable $th) {
            Log::throwable("SellerController -> register: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
