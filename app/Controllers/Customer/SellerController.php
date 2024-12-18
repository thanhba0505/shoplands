<?php

class SellerController
{
    public function show()
    {
        $data = [
            'title' => 'Seller Page',
        ];

        View::make('Customer/seller', $data, 'layout/layout-primary');
    }
}
