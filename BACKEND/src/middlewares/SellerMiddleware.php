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
    }
}
