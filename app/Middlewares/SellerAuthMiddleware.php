<?php

require_once 'app/Models/Seller.php';

class SellerAuthMiddleware
{
    public function handle()
    {
        // Xác thực đăng nhập
        $authMiddleware = new AuthMiddleware();
        $authMiddleware->handle();


        // Kiểm tra người bán
        $seller = new Seller();
        $currentSeller = $seller->getCurrentSeller();

        if (!$currentSeller) {
            Redirect::to('/seller/register');
        }
    }
}
