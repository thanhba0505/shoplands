<?php

namespace App\Middlewares;

use App\Helpers\Auth;
use App\Helpers\Response;

class ShipperMiddleware
{
    public function handle()
    {
        // Kiểm tra shipper đăng nhập
        $shipper = Auth::shipper();
        
        if (!$shipper) {
            Response::json(['message' => 'Đăng nhập người giao hàng để thực hiện hành động này'], 401);
        }
    }
}
