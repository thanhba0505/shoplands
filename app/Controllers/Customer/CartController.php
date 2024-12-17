<?php

class CartController
{
    public function index()
    {
        $data = [
            'title' => 'Cart Page',
        ];

        View::make('Customer/cart', $data, 'layout/layout-primary');
    }
}
