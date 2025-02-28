<?php

$router->get('/', 'Customer\HomeController@index');
$router->get('/cart', 'Customer\CartController@index');
