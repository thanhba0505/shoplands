<?php
$router->get('api/sql', 'Controller@sql');

// PUBLIC
// $router->get('api/public/logo', 'Public\ImageController@logoSvg');

// API AUTH
$router->post('api/auth/login', 'AuthController@login');
$router->post('api/auth/refresh-token', 'AuthController@refreshToken');
$router->post('api/auth/logout', 'AuthController@logout');
$router->post('api/auth/register', 'AuthController@register');

// API COUPON
$router->get('api/coupons/{seller_id}', 'CouponController@getBySellerId');

// API CATEGORY
$router->get('api/categories', 'CategoryController@getAll');

// API PRODUCT
$router->get('api/products', 'ProductController@getAll');
$router->get('api/products/{id}', 'ProductController@getByProductId');

// API CART
$router->get('api/cart', 'CartController@getAll', ['App\Middlewares\UserMiddleware']);
$router->post('api/cart', 'CartController@addCart', ['App\Middlewares\UserMiddleware']);
$router->put('api/cart', 'CartController@updateCart', ['App\Middlewares\UserMiddleware']);
$router->delete('api/cart', 'CartController@deleteCart', ['App\Middlewares\UserMiddleware']);

// API ADRESS
$router->get('api/address', 'AddressController@getAll', ['App\Middlewares\UserMiddleware']);
$router->get('api/address/seller/{id}', 'AddressController@fineBySellerId');
