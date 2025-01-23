<?php

require_once 'app/Models/ConnectDatabase.php';

class CustomerCareController
{
    public function show()
    {
        $listCustomerCare = Other::listCustomerCare();

        $data = [
            'title' => 'Chăm sóc khách hàng',
            'listCustomerCare' => $listCustomerCare
        ];

        return View::make('Seller/CustomerCare/index', $data, sidebar: 'seller');
    }

    public function apiHandleTab()
    {
        return Api::view('Seller/CustomerCare/tab', []);
    }
}
