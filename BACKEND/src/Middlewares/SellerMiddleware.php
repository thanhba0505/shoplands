<?php

namespace App\Middlewares;

use App\Helpers\Auth;
use App\Helpers\Response;

class SellerMiddleware
{
    public function handle()
    {
        // Kiểm tra seller đăng nhập
        $seller = Auth::seller();

        if (!$seller) {
            Response::json(['message' => 'Đăng nhập người bán để thực hiện hành động này'], 401);
        }

        if ($seller["status"] === "inactive") {
            Response::json(['message' => 'Tài khoản chưa hoạt động'], 401);
        }

        if ($seller["status"] === "unverified") {
            Response::json(['message' => 'Tài khoản chưa được xác thực'], 401);
        }

        if ($seller["status"] === "locked") {
            Response::json(['message' => 'Tài khoản đã bị khóa'], 401);
        }
    }
}
