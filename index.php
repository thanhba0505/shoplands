<?php

// Nạp các tệp cần thiết
require_once './config.php';
require_once './core/Session.php';
require_once './core/Router.php';
require_once './core/View.php';

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

// Xử lý request
$router->dispatch();
