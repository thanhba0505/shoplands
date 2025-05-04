<?php

// Đối tác
$router->get('master-data/province', 'AddressController@getProvinces');
$router->get('master-data/district', 'AddressController@getDistricts');
$router->get('master-data/ward', 'AddressController@getWards');


$router->post('v2/shipping-order/create', 'OrderController@create');

$router->post('v2/shipping-order/preview', 'OrderController@preview');
$router->post('v2/shipping-order/fee', 'OrderController@fee');
$router->post('v2/shipping-order/leadtime', 'OrderController@leadtime');



// Admin ghn
$router->get('update-status', 'OrderController@status');
$router->post('update-status', 'OrderController@status');












