<?php
$router->get('api/sql', 'Controller@sql');

// PUBLIC
// $router->get('api/public/logo', 'Public\ImageController@logoSvg');

// API AUTH
$router->post('api/auth/login', 'AuthController@login');
$router->post('api/auth/refresh-token', 'AuthController@refreshToken');
$router->post('api/auth/logout', 'AuthController@logout');
$router->post('api/auth/register', 'AuthController@register');
$router->post('api/auth/forgot-password', 'AuthController@forgotPassword');

// API COUPON
$router->get('api/coupons/{seller_id}', 'CouponController@getBySellerId');

// API CATEGORY
$router->get('api/categories', 'CategoryController@getAll');

// API PRODUCT
$router->get('api/products', 'ProductController@getAll');
$router->get('api/products/{id}', 'ProductController@getByProductId');

$router->get('api/seller/products', 'ProductController@sellerGetAll', ['App\Middlewares\SellerMiddleware']);
$router->post('api/seller/products', 'ProductController@sellerAdd', ['App\Middlewares\SellerMiddleware']);

// API CART
$router->get('api/user/cart', 'CartController@getAll', ['App\Middlewares\UserMiddleware']);
$router->post('api/user/cart', 'CartController@addCart', ['App\Middlewares\UserMiddleware']);
$router->put('api/user/cart', 'CartController@updateCart', ['App\Middlewares\UserMiddleware']);
$router->delete('api/user/cart', 'CartController@deleteCart', ['App\Middlewares\UserMiddleware']);
$router->post('api/user/cart/ids', 'CartController@getByCartIds', ['App\Middlewares\UserMiddleware']);

// API ADRESS
$router->get('api/user/address', 'AddressController@getAll', ['App\Middlewares\UserMiddleware']);
$router->get('api/address/{seller_id}', 'AddressController@fineBySellerId');

// API SHIPPING FEE
$router->get('api/shipping-fees', 'ShippingFeeController@getAll');

// API ORDER
$router->post('api/user/orders', 'OrderController@add', ['App\Middlewares\UserMiddleware']);
$router->post('api/user/orders/check-payment', 'OrderController@checkPayment', ['App\Middlewares\UserMiddleware']);
$router->get('api/user/orders', 'OrderController@getAll', ['App\Middlewares\UserMiddleware']);

$router->get('api/seller/orders', 'OrderController@getAllBySeller', ['App\Middlewares\SellerMiddleware']);
$router->get('api/seller/orders/{order_id}', 'OrderController@getByOrderId', ['App\Middlewares\SellerMiddleware']);
$router->post('api/seller/orders/{order_id}', 'OrderController@sellerAddStatus', ['App\Middlewares\SellerMiddleware']);