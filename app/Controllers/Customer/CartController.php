<?php

class CartController
{
    public function show()
    {
        $data = [
            'title' => 'Cart Page',
        ];

        View::make('Customer/cart', $data, 'layout/layout-primary');
    }
}
