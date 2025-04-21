<?php

namespace App\Controllers;

use App\Helpers\Response;
use App\Helpers\Log;
use App\Helpers\Request;
use App\Models\UserModel;

class UserController {
    // Admin lấy danh sách người bán
    public function adminGet() {
        try {
            $status = Request::get('status') && Request::get('status') != "all" ? Request::get('status') : "";
            $limit = Request::get('limit', 12);
            $page = Request::get('page', 0);

            $count = UserModel::countByStatus($status == "all" ? null : $status);
            $sellers = UserModel::getAll($status, $limit, $page);

            $result = [
                "count" => $count,
                "sellers" => $sellers
            ];

            Response::json($result);
        } catch (\Throwable $th) {
            Log::throwable("UserController -> adminGet: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
