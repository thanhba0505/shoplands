<?php

namespace App\Helpers;

class Request
{
    // Phương thức kiểm tra request method
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    // Phương thức để lấy giá trị từ $_POST
    public static function post($value, $default = null)
    {
        if (isset($_POST[$value])) {
            $data = $_POST[$value];
            // Nếu là mảng và không có dữ liệu, trả về mảng rỗng
            if (is_array($data) && empty($data)) {
                return $default ?? [];
            }
            return $data;
        }
        return $default;
    }

    // Phương thức để lấy giá trị từ $_GET
    public static function get($value, $default = null)
    {
        if (isset($_GET[$value])) {
            $data = $_GET[$value];
            // Nếu là mảng và không có dữ liệu, trả về mảng rỗng
            if (is_array($data) && empty($data)) {
                return $default ?? [];
            }
            return $data;
        }
        return $default;
    }
}
