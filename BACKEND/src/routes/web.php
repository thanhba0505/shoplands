<?php
$router->get('api/sql', 'Controller@sql');

// PUBLIC
$router->get('api/public/logo', 'Public\ImageController@logoSvg');

// API AUTH
$router->post('api/auth/login', 'AuthController@login');
$router->post('api/auth/refresh-token', 'AuthController@refreshToken');
$router->post('api/auth/logout', 'AuthController@logout');

// API CART
$router->get('api/carts', 'User\CartController@getAll', ['App\Middlewares\UserMiddleware']);

