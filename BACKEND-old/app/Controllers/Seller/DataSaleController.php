<?php

require_once 'app/Models/ConnectDatabase.php';

class DataSaleController
{
    public function show()
    {
        $listDataSale = Other::listDataSale();

        $data = [
            'title' => 'Khuyến mãi',
            'listDataSale' => $listDataSale
        ];

        return View::make('Seller/DataSale/index', $data, sidebar: 'seller');
    }

    public function apiHandleTab()
    {
        return Api::view('Seller/DataSale/tab', []);
    }
}
