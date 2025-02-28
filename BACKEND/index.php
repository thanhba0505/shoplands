<?php

require 'vendor/autoload.php';

use App\Core\Router;
use Dotenv\Dotenv;

// Lấy thông tin env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Lấy config
require './config.php';

// Khởi tạo Router
$router = new Router();
require './src/routes/web.php';

// Xử lý request
$router->dispatch();
