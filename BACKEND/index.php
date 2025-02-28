<?php

require 'vendor/autoload.php';

use App\Core\Router;

// Lấy thông tin env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Lấy config
require './config.php';

// Khởi tạo Router
$router = new Router();
require './src/routes/web.php';

// Xử lý request
$router->dispatch();
