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

    public function apiAdd() {

        $user = Auth::getUser() ?? null;
        $product_variant_id = Request::post('product_variant_id');
        $quantity = Request::post('quantity');

        $cart = new Cart();
        $result = $cart->addCart($user['id'], $product_variant_id, $quantity);

        if (!$result) {
            return Api::encode('Thêm vào giỏ hàng khônng thành công', 'error');
        } 

        return Api::encode('Thêm vào giỏ hàng thành công', 'success');
    }
}
