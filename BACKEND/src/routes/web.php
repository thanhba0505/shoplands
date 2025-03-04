<?php
$router->get('api/sql', 'Controller@sql');

// PUBLIC
$router->get('api/public/logo', 'Public\ImageController@logoSvg');

// API AUTH
$router->post('api/login', 'AuthController@login');
$router->post('api/refresh-token', 'AuthController@refreshToken');
$router->post('api/logout', 'AuthController@logout');

// API CART
$router->get('api/carts', 'CartController@getAll', ['App\Middlewares\UserMiddleware']);

// API CATEGORY
$router->get('api/categories', 'CategoryController@getAll');

// API PRODUCT
$router->get('api/products', 'ProductController@getAll');

// API PRODUCT VARIANT
// $router->get('api/product-variants', 'ProductVariantController@getAll');

