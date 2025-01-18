<?php
require_once 'app/Models/Product.php';

class ProductController
{
    public function show()
    {
        // Gọi model đến sản phẩm
        $product = new Product();
        $product_result = $product->getProducts();

        $data = [
            'title' => 'Product Page',
            'sidebar' => 'products',
            'products' => $product_result ? $product_result : []
        ];

        return View::make('Customer/products', $data, 'layout/layout-sidebar');
    }
}
