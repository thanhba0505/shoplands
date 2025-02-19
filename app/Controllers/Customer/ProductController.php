<?php
require_once 'app/Models/Product.php';
require_once 'app/Models/Category.php';

class ProductController
{
    public function show()
    {
        $filter = [
            'min_price' => Request::get('min_price'),
            'max_price' => Request::get('max_price'),
            'categories' => Request::get('categories', []),
            'ratings' => Request::get('ratings', [])
        ];

        $arrange = [
            'latest' => Request::get('latest'),
            'popular' => Request::get('popular'),
            'price' => in_array(Request::get('price'), ['asc', 'desc']) ? Request::get('price') : '',
        ];

        // Gọi model đến sản phẩm
        $productModel = new Product();
        $products = $productModel->getProducts(20);

        // Gọi model đến danh mục
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        $data = [
            'title' => 'Product Page',
            'products' => $products,
            'categories' => $categories,
            'filter' => $filter,
            'arrange' => $arrange
        ];

        return View::make('Customer/products', $data);
    }

    // xử lý lọc sản phẩm
    public function filter()
    {




        return 'xử lý lọc sản phẩm';
    }
}
