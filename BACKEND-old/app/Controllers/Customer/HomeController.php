<?php

require_once 'app/Controllers/Controller.php';
require_once 'app/Models/Product.php';
require_once 'app/Models/Category.php';

class HomeController extends Controller
{
    public function show()
    {
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        $products = $this->getProducts();

        $data = [
            'title' => 'Trang chủ',
            'products' => $products,
            'categories' => $categories,
        ];

        return View::make('Customer/home', $data);
    }

    public function logo()
    {
        $path = Other::logoSvg();

        return Api::response([
            'success' => true,
            'data' => $path
        ]);
    }

    public function miniLogo()
    {
        $path = Asset::getImgApp('mini-logo.png');

        return Api::response([
            'success' => true,
            'data' => $path
        ]);
    }
}
