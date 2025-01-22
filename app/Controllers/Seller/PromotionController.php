<?php

require_once 'app/Models/ConnectDatabase.php';

class PromotionController
{
    public function show()
    {
        $listPromotion = Other::listPromotion();

        $data = [
            'title' => 'Khuyến mãi',
            'group' => 'product',
            'listPromotion' => $listPromotion
        ];

        return View::make('Seller/Product/index', $data, 'layout/layout-sidebar');
    }

    public function apiHandleTab()
    {
        $response = [];

        $response = [
            'status' => 'success',
            'content' => View::make('Seller/Product/tab-product', [], 'layout/no-layout'),
        ];

        return $response;
    }
}
