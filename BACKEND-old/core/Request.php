<?php

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
            return self::sanitize($data);
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
            return self::sanitize($data);
        }
        return $default;
    }

    // Phương thức để mã hóa dữ liệu tránh XSS
    private static function sanitize($value)
    {
        if (is_array($value)) {
            // Nếu là mảng, áp dụng sanitize cho từng phần tử
            return array_map(function ($item) {
                return self::sanitize($item);
            }, $value);
        }
        // Dùng htmlspecialchars để mã hóa các ký tự đặc biệt
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
