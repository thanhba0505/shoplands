<?php

require_once 'app/Models/Seller.php';

class SellerAuthMiddleware
{
    public function handle()
    {
        $authMiddleware = new AuthMiddleware();
        $authMiddleware->handle();

        $accessToken  = Cookie::get('access_token');

        $userId = Token::getUserId($accessToken);

        $seller = new Seller();

        if (!$seller->isSeller($userId)) {
            Redirect::to('/seller/register');
        }
    }
}
