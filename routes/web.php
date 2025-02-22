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


// API
$router->get('/api/product-variant/check-stock', 'Api/ProductVariantApi@checkStock');
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// CẦN ĐĂNG NHẬP KHÁCH HÀNG ================================================================================================================================================
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// Trang giỏ hàng ---------------------------------------------------------------------
$router->get('/cart', 'Customer/CartController@show', [AuthMiddleware::class]);
$router->post('/api/cart/add', 'Customer/CartController@apiAdd', [AuthMiddleware::class]);
$router->post('/api/cart/delete', 'Customer/CartController@apiDelete', [AuthMiddleware::class]);

// Trang xác nhận đặt hàng ---------------------------------------------------------------------
$router->get('/order/confirm', 'Customer/OrderController@showConfirm', [AuthMiddleware::class]);
$router->post('/order/confirm', 'Customer/OrderController@showConfirm', [AuthMiddleware::class]);

// Trang đơn hàng ---------------------------------------------------------------------
$router->get('/order/history', 'Customer/OrderController@showHistory', [AuthMiddleware::class]);


// Trang thiết lập thông tin ---------------------------------------------------------------------
$router->get('/account-setting', 'Customer/AccountSettingController@show', [AuthMiddleware::class]);



// Trang đăng ký bán hàng ---------------------------------------------------------------------
$router->get('/seller/register', 'Seller/SellerRegisterController@show', [AuthMiddleware::class]);

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// CẦN ĐĂNG NHẬP NGƯỜI BÁN  ================================================================================================================================================
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// Quản lý đơn hàng ---------------------------------------------------------------------
$router->get('/seller/order', 'Seller/OrderController@show', [SellerAuthMiddleware::class]);
$router->get('/seller/order/detail', 'Seller/OrderController@showDetail', [SellerAuthMiddleware::class]);

$router->post('api/seller/order/tab', 'Seller/OrderController@apiHandleTab');

// Quản lý sản phẩm
$router->get('/seller/product', 'Seller/ProductController@show', [SellerAuthMiddleware::class]);

$router->post('api/seller/product/tab', 'Seller/ProductController@apiHandleTab');

// Khuyến mãi
$router->get('/seller/promotion', 'Seller/PromotionController@show', [SellerAuthMiddleware::class]);

$router->post('api/seller/promotion/tab', 'Seller/PromotionController@apiHandleTab');

// Chăm sóc khách hàng
$router->get('/seller/customer-care', 'Seller/CustomerCareController@show', [SellerAuthMiddleware::class]);

$router->post('api/seller/customer-care/tab', 'Seller/CustomerCareController@apiHandleTab');

// Dữ liệu
$router->get('/seller/data-sale', 'Seller/DataSaleController@show', [SellerAuthMiddleware::class]);

$router->post('api/seller/data-sale/tab', 'Seller/DataSaleController@apiHandleTab');

// Quản lý cửa hàng
$router->get('/seller/admin', 'Seller/AdminController@show', [SellerAuthMiddleware::class]);

$router->post('api/seller/admin/tab', 'Seller/AdminController@apiHandleTab');






// test SQL
$router->get('/sql', 'ErrorController@sql');