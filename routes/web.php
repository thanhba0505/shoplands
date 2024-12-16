<?php

$router->get('/', 'Customer/HomeController@index');
$router->get('/product', 'Customer/ProductController@index');
$router->get('/cart', 'Customer/CartController@index', [AuthMiddleware::class]);

$router->get('/login', 'Auth/LoginController@show');
$router->get('/register', 'Auth/RegisterController@show');


// $router->get('/cart', 'Customer/CartController@index', [AuthMiddleware::class, AuthMiddleware::class]);