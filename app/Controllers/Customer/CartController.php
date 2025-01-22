<?php

require_once 'app/Models/Cart.php';

class CartController
{
    public function show()
    {
        $user = Auth::getUser() ?? null;

        $cart = new Cart();
        $cart_result = $cart->getAllByUserId($user['id']);

        $data = [
            'title' => 'Giỏ hàng',
            'carts' => $cart_result
        ];

        return View::make('Customer/cart', $data);
    }
}
