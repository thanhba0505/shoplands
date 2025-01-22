<?php

require_once 'app/Models/Product.php';
require_once 'app/Models/Category.php';

class HomeController
{
    public function show()
    {
        // GỌI MODEL ĐẾN SẢN PHẨM
        $product = new Product();
        $product_result = $product->getProducts();

        $category = new Category();
        $category_result = $category->getAll();

        $data = [
            'title' => 'Trang chủ',
            'products' => $product_result ? $product_result : [],
            'categories' => $category_result ? $category_result : [],
        ];

        return View::make('Customer/home', $data);
    }
}
