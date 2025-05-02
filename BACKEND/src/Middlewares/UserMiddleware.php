<?php

namespace App\Middlewares;

use App\Helpers\Auth;
use App\Helpers\Response;

class UserMiddleware {
    public function handle() {
        // Kiểm tra user đăng nhập
        $user = Auth::user();

        if (!$user) {
            Response::json(['message' => 'Đăng nhập người dùng để thực hiện hành động này'], 401);
        }

        if ($user["status"] === "inactive") {
            Response::json(['message' => 'Tài khoản chưa hoạt động'], 401);
        }

        if ($user["status"] === "unverified") {
            Response::json(['message' => 'Tài khoản chưa được xác thực'], 401);
        }

        if ($user["status"] === "locked") {
            Response::json(['message' => 'Tài khoản đã bị khóa'], 401);
        }
    }
}
