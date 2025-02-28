<?php

$router->get('/', 'Customer\HomeController@index');
$router->get('/cart', 'Customer\CartController@index');

$router->post('api/auth/login', 'Auth\Auth@login');
$router->post('api/auth/refresh-token', 'Auth\Auth@refreshToken');
$router->post('api/auth/logout', 'Auth\Auth@logout');
