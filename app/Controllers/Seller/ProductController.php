<?php

require_once 'app/Models/ConnectDatabase.php';
require_once 'app/Models/Product.php';

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
        $listProductStatus = Other::listProductStatus();

        $page = Request::post('page');

        if (!array_key_exists($page, $listProductStatus)) {
            return Api::encode('Trang khônng tốn tại', 'error');
        }

        $user = Auth::getUser();
        $sellerModel = new Seller();
        $seller = $sellerModel->findByUserId($user['id']);

        $product = new Product();
        $products = $product->getProductsBySellerId($seller['id'], $page == 'product-all' ? null : $page, 12);

        $data = ['products' => $products, 'listProductStatus' => $listProductStatus];

        return Api::view('Seller/Product/tab', $data);
    }
}
