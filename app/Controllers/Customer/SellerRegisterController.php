<?php

class SellerRegisterController
{
    public function show()
    {
        $data = [
            'title' => 'Seller Register Page',
        ];

        View::make('Customer/seller-register', $data, 'layout/layout-header-simple');
    }
}
