<?php

namespace App\Middlewares;

use App\Helpers\Auth;
use App\Helpers\Response;

class ShipperMiddleware
{
    public function handle()
    {
        // Kiểm tra user đăng nhập
        // $user = Auth::user();

        // if (!$user) {
        //     Response::json(['message' => 'Đăng nhập người dùng để thực hiện hành động này'], 401);
        // }
    }
}
