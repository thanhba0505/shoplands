<?php

namespace App\Middlewares;

use App\Helpers\Auth;
use App\Helpers\Response;

class AdminMiddleware
{
    public function handle()
    {
        // Kiểm tra admin đăng nhập
        $admin = Auth::admin();
        
        if (!$admin) {
            Response::json(['message' => 'Đăng nhập quản trị viên để thực hiện hành động này'], 401);
        }
    }
}
