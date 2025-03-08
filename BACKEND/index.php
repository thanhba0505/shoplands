<?php

require 'vendor/autoload.php';

use App\Core\Router;
use App\Helpers\Response;
use Dotenv\Dotenv;

// Cài đặt múi giờ
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Lấy thông tin env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Lấy config
require './config.php';




// Kiểm tra và thêm header CORS chỉ cho phép frontend từ một địa chỉ cụ thể
$allowedOrigin = $_ENV['FRONTEND_URL']; // Đọc từ file .env
$isDevelopment = $_ENV['ENVIRONMENT'] === "DEVELOPMENT";

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

// Chỉ cho phép frontend từ địa chỉ cho trước  ( || để cho test api )
if (($origin && $origin === $allowedOrigin)) {
    header("Access-Control-Allow-Origin: $origin");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
}

if (!$isDevelopment) {
    // Nếu không phải từ địa chỉ frontend cho phép, từ chối yêu cầu (hoặc trả về lỗi)
    Response::json(['success' => false, 'message' => 'Không có quyền truy cập'], 401);
}

// Xử lý request cho các phương thức OPTIONS (preflight request)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    Response::json(['success' => true, 'message' => 'OK']);
    exit(0);  // Kết thúc yêu cầu OPTIONS
}




// Log dữ liệu nhận được từ frontend
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Kiểm tra xem dữ liệu có được gửi lên không
//     $data = json_decode(file_get_contents('php://input'), true);

//     if ($data) {
//         // Bạn có thể lưu log vào một file riêng nếu muốn:
//         $logData = print_r($data, true);
//         file_put_contents('data.log', $logData . PHP_EOL, FILE_APPEND);
//     } else {
//         error_log("No data received or data is not valid JSON.");
//     }
// }




// Khởi tạo Router
$router = new Router();
require './src/routes/web.php';

// Xử lý request
$router->dispatch();
