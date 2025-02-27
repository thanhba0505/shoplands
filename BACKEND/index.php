<?php

// Nạp các tệp cần thiết
require_once './config.php';
require_once './core/Session.php';
require_once './core/Cookie.php';
require_once './core/Router.php';
require_once './core/Auth.php';
require_once './core/View.php';
require_once './core/Util.php';
require_once './core/Token.php';
require_once './core/Request.php';
require_once './core/CSRF.php';
require_once './core/Redirect.php';
require_once './core/Asset.php';
require_once './core/Notification.php';
require_once './core/Other.php';
require_once './core/Console.php';
require_once './core/Api.php';
// Tạo session bảo mật
Session::init();

// Tạo cookie bảo mật
Cookie::init();

// Autoload các middleware
spl_autoload_register(function ($class) {
    $middlewarePath = './app/Middlewares/' . $class . '.php';
    if (file_exists($middlewarePath)) {
        require_once $middlewarePath;
    }
});

// Tạo router và nạp route
$router = new Router();
require_once './routes/web.php';

//Tạo token csrf
if (!CSRF::getToken()) {
    CSRF::generateToken();
}

$router->dispatch();
