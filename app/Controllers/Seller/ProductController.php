<?php

require_once 'app/Models/ConnectDatabase.php';

class ProductController
{
    public function show()
    {
        // $listStatus = Other::listOrderStatus();

        // $page = Request::get('page');

        // if (!array_key_exists($page, $listStatus)) {
        //     Redirect::seller()->withQuery(['page' => 'all'])->redirect();
        // }

        // $user = Auth::getUser();
        // $sellerModel = new Seller();
        // $seller = $sellerModel->findByUserId($user['id']);

        $page = Request::get('page', 'all');

        if (!in_array($page, ['all', 'in-stock', 'out-of-stock', 'locked', 'hidden', 'deleted'])) {
            Redirect::seller('product')->redirect();
        }

        $data = [
            'title' => 'Seller Page',
            'title_header' => 'Kênh người bán',
            'group' => 'product',
            'page' => $page,
        ];

        

        return View::make('Seller/Product/index', $data, 'layout/layout-sidebar');
    }
}
