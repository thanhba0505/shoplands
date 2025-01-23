<?php

require_once 'app/Models/ConnectDatabase.php';

class PromotionController
{
    public function show()
    {
        $listPromotion = Other::listPromotion();

        $data = [
            'title' => 'Khuyến mãi',
            'listPromotion' => $listPromotion
        ];

        return View::make('Seller/Promotion/index', $data, sidebar: 'seller');
    }

    public function apiHandleTab()
    {
        return Api::view('Seller/Promotion/tab', []);
    }
}
