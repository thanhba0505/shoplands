<?php
require_once 'app/Models/Product.php';

class ShopController
{
    public function show()
    {
        $id = Request::get('id');

        // Gọi model đến sản phẩm
        $product = new Product();
        $product_result = $product->getProducts();

        $data = [
            'title' => 'Shop Page',
            'id' => $id,
            'products' => $product_result
        ];

        return View::make('Customer/shop', $data);
    }
}
