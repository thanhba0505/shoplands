<?php

require_once 'app/Models/Product.php';

class HomeController
{
    public function show()
    {
        // GỌI MODEL ĐẾN SẢN PHẨM
        $product = new Product();
        $result = $product->getProducts();

        Console::log($result);

        $data = [
            'title' => 'Trang chủ',
        ];

        // Render view với layout
        View::make('Customer/home', $data, 'layout/layout-primary');
    }
}
