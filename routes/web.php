<?php

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// KHÔNG CẦN ĐĂNG NHẬP  ================================================================================================================================================
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$router->get('/', 'Customer/HomeController@show');
$router->get('/404', 'ErrorController@show');

// Trang xác thực ---------------------------------------------------------------------
$router->get('/login', 'Auth/LoginController@show');
$router->post('/login', 'Auth/LoginController@login');

$router->get('/logout', 'Auth/LoginController@logout');

$router->get('/register', 'Auth/RegisterController@show');


// Trang sản phẩm ---------------------------------------------------------------------
$router->get('/product', 'Customer/ProductController@show');

// Trang chi tiết sản phẩm ---------------------------------------------------------------------
$router->get('/product/detail', 'Customer/ProductDetailController@show');

// Trang bài viết ---------------------------------------------------------------------
$router->get('/post', 'Customer/PostController@show');

// Trang shop ---------------------------------------------------------------------
$router->get('/shop', 'Customer/ShopController@show');



// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// CẦN ĐĂNG NHẬP KHÁCH HÀNG ================================================================================================================================================
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// Trang giỏ hàng ---------------------------------------------------------------------
$router->get('/cart', 'Customer/CartController@show', [AuthMiddleware::class]);

// Trang giỏ hàng ---------------------------------------------------------------------
$router->get('/order', 'Customer/OrderController@show', [AuthMiddleware::class]);


// Trang thiết lập thông tin ---------------------------------------------------------------------
$router->get('/account-setting', 'Customer/AccountSettingsController@show', [AuthMiddleware::class]);



// Trang đăng ký bán hàng ---------------------------------------------------------------------
$router->get('/seller/register', 'Seller/SellerRegisterController@show', [AuthMiddleware::class]);

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// CẦN ĐĂNG NHẬP NGƯỜI BÁN  ================================================================================================================================================
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// Quản lý đơn hàng ---------------------------------------------------------------------
$router->get('/seller/order', 'Seller/OrderController@show', [SellerAuthMiddleware::class]);

// // Quản lý sản phẩm
$router->get('/seller/product', 'Seller/ProductController@show', [SellerAuthMiddleware::class]);
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

// $router->get('/cart', 'Customer/CartController@show', [AuthMiddleware::class, AuthMiddleware::class]);