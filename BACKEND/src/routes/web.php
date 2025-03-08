<?php
$router->get('api/sql', 'Controller@sql');

// PUBLIC
$router->get('api/public/logo', 'Public\ImageController@logoSvg');

// API AUTH
$router->post('api/login', 'AuthController@login');
$router->post('api/refresh-token', 'AuthController@refreshToken');
$router->post('api/logout', 'AuthController@logout');
$router->post('api/send-verification-code', 'AuthController@sendVerificationCode');
$router->post('api/register', 'AuthController@register');

// API CART
$router->get('api/cart', 'CartController@getAll', ['App\Middlewares\UserMiddleware']);
$router->post('api/cart', 'CartController@addCart', ['App\Middlewares\UserMiddleware']);
$router->put('api/cart', 'CartController@updateCart', ['App\Middlewares\UserMiddleware']);
$router->delete('api/cart', 'CartController@deleteCart', ['App\Middlewares\UserMiddleware']);

// API CATEGORY
$router->get('api/categories', 'CategoryController@getAll');

// API PRODUCT
$router->get('api/products', 'ProductController@getAll');
$router->get('api/products/{id}', 'ProductController@getByProductId');

// API PRODUCT VARIANT
// $router->get('api/product-variants', 'ProductVariantController@getAll');

