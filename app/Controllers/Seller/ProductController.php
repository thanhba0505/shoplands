<?php

require_once 'app/Models/ConnectDatabase.php';

class ProductController
{
    public function show()
    {
        $listProductStatus = Other::listProductStatus();

        $data = [
            'title' => 'Seller Page',
            'listProductStatus' => $listProductStatus
        ];

        return View::make('Seller/Product/index', $data, sidebar: 'seller');
    }

    public function apiHandleTab()
    {
        return Api::view('Seller/Product/tab-product', []);
    }
}
