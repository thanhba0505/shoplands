<?php

require_once 'app/Models/ConnectDatabase.php';

class ProductController
{
    public function show()
    {
        $listProductStatus = Other::listProductStatus();

        $data = [
            'title' => 'Seller Page',
            'title_header' => 'Kênh người bán',
            'group' => 'product',
            'listProductStatus' => $listProductStatus
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
