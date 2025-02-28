<?php
$router->get('api/sql', 'Controller@sql');

$router->post('api/auth/login', 'Auth\Auth@login');
$router->post('api/auth/refresh-token', 'Auth\Auth@refreshToken');
$router->post('api/auth/logout', 'Auth\Auth@logout');
