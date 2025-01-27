<?php
require_once 'app/Models/Product.php';
require_once 'app/Models/Category.php';

class ProductController
{
    public function show()
    {
        // Gọi model đến sản phẩm
        $productModel = new Product();
        $products = $productModel->getProducts();
        
        // Gọi model đến danh mục
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        $data = [
            'title' => 'Product Page',
            'products' => $products ? $products : [],
            'categories' => $categories
        ];

        return View::make('Customer/products', $data, sidebar: 'products');
    }
}
