<?php

require_once 'app/Models/Seller.php';

class SellerAuthMiddleware
{
    public function handle()
    {
        $result = Auth::checkAuth('seller');

        if (!$result) {
            Redirect::to('/seller/register');
        }
    }
}
