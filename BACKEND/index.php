<?php

require 'vendor/autoload.php';

use App\Core\Router;

// Khởi tạo Router
$router = new Router();
require './src/routes/web.php';

// Xử lý request
$router->dispatch();
