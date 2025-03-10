<?php

namespace App\Helpers;

class Request
{
    // Phương thức kiểm tra request method
    public static function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    // Lấy giá trị từ $_POST
    public static function post($value, $default = null)
    {
        if (isset($_POST[$value])) {
            $data = $_POST[$value];
            return is_array($data) && empty($data) ? ($default ?? []) : $data;
        }
        return $default;
    }

    // Lấy giá trị từ $_GET
    public static function get($value, $default = null)
    {
        if (isset($_GET[$value])) {
            $data = $_GET[$value];
            return is_array($data) && empty($data) ? ($default ?? []) : $data;
        }
        return $default;
    }

    // Lấy giá trị từ HTTP headers
    public static function getHeader($name, $default = null)
    {
        $headers = getallheaders();
        return $headers[$name] ?? $default;
    }

    // Lấy dữ liệu JSON từ body của request theo key hoặc tất cả nếu key là null
    public static function json($key = null, $default = null)
    {
        // Đảm bảo chỉ lấy dữ liệu khi content-type là application/json
        if (self::getHeader('Content-Type') === 'application/json') {
            $data = json_decode(file_get_contents('php://input'), true);

            // Nếu không có dữ liệu hoặc dữ liệu rỗng, trả về default
            if (empty($data)) {
                return $default;
            }

            // Nếu có key, trả về giá trị tương ứng với key, nếu không trả về toàn bộ dữ liệu
            return $key === null ? $data : ($data[$key] ?? $default);
        }
        return $default;
    }

    // Lấy giá trị từ $_SERVER
    public static function getServer($value, $default = null)
    {
        return $_SERVER[$value] ?? $default;
    }
}
