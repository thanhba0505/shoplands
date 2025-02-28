<?php

namespace App\Middlewares;

use App\Helpers\Auth;
use App\Helpers\Response;

class SellerMiddleware
{
    public function handle()
    {
        // Kiểm tra user đăng nhập
        $user = Auth::user();

        if (!$user) {
            Response::json(['success' => false, 'message' => 'Không có quyền truy cập'], 401);
        }
    }
}
