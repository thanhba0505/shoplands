<?php

require_once 'app/Models/Cart.php';

class CartController
{
    public function show()
    {

        $cart = new Cart();
        $cart_result = $cart->getAll();

        $data = [
            'title' => 'Cart Page',
            'carts' => $cart_result
        ];

        View::make('Customer/cart', $data, 'layout/layout-primary');
    }
}
