<?php

$router->get('/', 'Customer/HomeController@show');

// Trang sản phẩm ---------------------------------------------------------------------
$router->get('/product', 'Customer/ProductController@show');

// Trang giỏ hàng ---------------------------------------------------------------------
$router->get('/cart', 'Customer/CartController@show');

// Trang bài viết ---------------------------------------------------------------------
$router->get('/post', 'Customer/PostController@show');

// Trang bán hàng ---------------------------------------------------------------------
// Trang đăng ký bán hàng
$router->get('/seller/register', 'Seller/SellerRegisterController@show');

// Quản lý đơn hàng
$router->get('/seller/orders/{page}', 'Seller/OrderController@show');

// // Quản lý sản phẩm
$router->get('/seller/products/{page}', 'Seller/ProductController@show');
// $router->get('/seller/products/in-stock', 'Seller/ProductController@inStock');
// $router->get('/seller/products/out-of-stock', 'Seller/ProductController@outOfStock');
// $router->get('/seller/products/locked', 'Seller/ProductController@locked');
// $router->get('/seller/products/hidden', 'Seller/ProductController@hidden');
// $router->get('/seller/products/deleted', 'Seller/ProductController@deleted');

// // Kênh marketing
// $router->get('/seller/marketing/discount-codes', 'Seller/MarketingController@discountCodes');
// $router->get('/seller/marketing/combo-deals', 'Seller/MarketingController@comboDeals');
// $router->get('/seller/marketing/flash-sales', 'Seller/MarketingController@flashSales');

// // Quản lý đánh giá
// $router->get('/seller/reviews/all', 'Seller/ReviewController@all');
// $router->get('/seller/reviews/unanswered', 'Seller/ReviewController@unanswered');
// $router->get('/seller/reviews/answered', 'Seller/ReviewController@answered');

// // Cài đặt cửa hàng
// $router->get('/seller/store/settings', 'Seller/StoreController@settings');
// $router->get('/seller/store/decor', 'Seller/StoreController@decor');
// $router->get('/seller/store/highlight-products', 'Seller/StoreController@highlightProducts');

// Trang xác thực ---------------------------------------------------------------------
$router->get('/login', 'Auth/LoginController@show');
$router->post('/login', 'Auth/LoginController@login');
$router->get('/register', 'Auth/RegisterController@show');


// $router->get('/cart', 'Customer/CartController@show', [AuthMiddleware::class, AuthMiddleware::class]);