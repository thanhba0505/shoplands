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

    // ✅ Lấy giá trị từ HTTP headers
    public static function getHeader($name, $default = null)
    {
        $headers = getallheaders();
        return $headers[$name] ?? $default;
    }
}
