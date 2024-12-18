<?php

$router->get('/', 'Customer/HomeController@show');

// Trang sản phẩm
$router->get('/product', 'Customer/ProductController@show');

// Trang giỏ hàng
$router->get('/cart', 'Customer/CartController@show');

// Trang bài viết
$router->get('/post', 'Customer/PostController@show');

// Trang bán hàng
$router->get('/seller', 'Customer/SellerController@show');

// Trang đăng ký bán hàng
$router->get('/seller-register', 'Customer/SellerRegisterController@show');

// Trang xác thực
$router->get('/login', 'Auth/LoginController@show');
$router->get('/register', 'Auth/RegisterController@show');


// $router->get('/cart', 'Customer/CartController@show', [AuthMiddleware::class, AuthMiddleware::class]);