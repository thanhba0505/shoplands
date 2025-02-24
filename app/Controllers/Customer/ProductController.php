<?php
require_once 'app/Models/Category.php';
require_once 'app/Controllers/Controller.php';

class ProductController extends Controller
{
    public function show()
    {
        $filter = [
            'min_price' => Request::get('min_price'),
            'max_price' => Request::get('max_price'),
            'categories' => Request::get('categories', []),
            'ratings' => Request::get('ratings', []),
            'search' => Request::get('search'),
        ];

        $arrange = [
            'top-rated' => Request::get('top-rated'),
            'top-seller' => Request::get('top-seller'),
            'price' => in_array(Request::get('price'), ['asc', 'desc']) ? Request::get('price') : null,
        ];

        $products = $this->getProducts(20, $filter, $arrange);

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
}
