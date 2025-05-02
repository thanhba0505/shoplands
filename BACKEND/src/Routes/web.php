<?php
// API AUTH
$router->post('api/auth/login', 'AuthController@login');
$router->post('api/auth/code-login', 'AuthController@getCodeLogin');
$router->post('api/auth/refresh-token', 'AuthController@refreshToken');
$router->post('api/auth/logout', 'AuthController@logout');
$router->post('api/auth/register', 'AuthController@register');
$router->post('api/auth/code-register', 'AuthController@getCodeRegister');
$router->post('api/auth/forgot-password', 'AuthController@forgotPassword');
$router->post('api/auth/code-forgot-password', 'AuthController@getCodeForgotPassword');

// API COUPON
$router->get('api/coupons/{seller_id}', 'CouponController@get');

// API CATEGORY
$router->get('api/categories', 'CategoryController@get');

// API PRODUCT
$router->get('api/products', 'ProductController@get');
$router->get('api/products/{id}', 'ProductController@find');

$router->post('api/seller/products', 'ProductController@sellerAdd', ['App\Middlewares\SellerMiddleware']);
$router->put('api/seller/products/{product_id}', 'ProductController@sellerUpdate', ['App\Middlewares\SellerMiddleware']);

// API CART
$router->get('api/user/cart', 'CartController@userGet', ['App\Middlewares\UserMiddleware']);
$router->post('api/user/cart', 'CartController@userAdd', ['App\Middlewares\UserMiddleware']);
$router->put('api/user/cart', 'CartController@userUpdate', ['App\Middlewares\UserMiddleware']);
$router->delete('api/user/cart', 'CartController@userDelete', ['App\Middlewares\UserMiddleware']);
$router->post('api/user/cart/ids', 'CartController@find', ['App\Middlewares\UserMiddleware']);

// API ADRESS
$router->get('api/address/provinces', 'AddressController@getProvinces');
$router->get('api/address/districts', 'AddressController@getDistricts');
$router->get('api/address/wards', 'AddressController@getWards');

$router->get('api/user/address', 'AddressController@userGet', ['App\Middlewares\UserMiddleware']);
$router->post('api/user/address', 'AddressController@userAdd', ['App\Middlewares\UserMiddleware']);
$router->put('api/user/address', 'AddressController@userUpdateDefault', ['App\Middlewares\UserMiddleware']);
$router->delete('api/user/address/{address_id}', 'AddressController@userDelete', ['App\Middlewares\UserMiddleware']);

$router->get('api/address/{seller_id}', 'AddressController@find');

// API ORDER
$router->get('api/user/orders', 'OrderController@userGet', ['App\Middlewares\UserMiddleware']);
$router->get('api/user/orders/check-payment', 'OrderController@userCheckPayment');
$router->get('api/user/orders/shipping-fee/{address_id}/{seller_id}', 'OrderController@userGetShippingFee', ['App\Middlewares\UserMiddleware']);
$router->get('api/user/orders/{order_id}', 'OrderController@userFind', ['App\Middlewares\UserMiddleware']);
$router->post('api/user/orders/link-payment', 'OrderController@userGetPaymentLink', ['App\Middlewares\UserMiddleware']);
$router->put('api/user/orders/delete/{order_id}', 'OrderController@userDelete', ['App\Middlewares\UserMiddleware']);
$router->put('api/user/orders/cancel/{order_id}', 'OrderController@userCancel', ['App\Middlewares\UserMiddleware']);
$router->put('api/user/orders/return/{order_id}', 'OrderController@userReturn', ['App\Middlewares\UserMiddleware']);
$router->put('api/user/orders/complete/{order_id}', 'OrderController@userComplete', ['App\Middlewares\UserMiddleware']);
$router->post('api/user/orders', 'OrderController@userAdd', ['App\Middlewares\UserMiddleware']);

$router->get('api/seller/orders', 'OrderController@sellerGet', ['App\Middlewares\SellerMiddleware']);
$router->get('api/seller/orders/{order_id}', 'OrderController@sellerFind', ['App\Middlewares\SellerMiddleware']);

$router->get('api/update-status-orders', 'OrderController@updateStatusOrders');
$router->post('api/update-status', 'OrderController@updateStatus');

// API SELLER
$router->get('api/admin/sellers', 'SellerController@adminGet', ['App\Middlewares\AdminMiddleware']);
$router->put('api/admin/sellers/register', 'SellerController@adminHandleRegister', ['App\Middlewares\AdminMiddleware']);
$router->put('api/admin/sellers/locked', 'SellerController@adminHandleLocked', ['App\Middlewares\AdminMiddleware']);
$router->post('api/sellers/register', 'SellerController@register');
$router->post('api/sellers/code-register', 'SellerController@getCodeRegister');
$router->get('api/sellers/{seller_id}', 'SellerController@find');

// API USER
$router->get('api/admin/users', 'UserController@adminGet', ['App\Middlewares\AdminMiddleware']);

// API OTHER
$router->get('api/banks', 'Controller@getBanks');