<?php

class Request
{
    // Phương thức để lấy giá trị từ $_POST
    public static function post($value, $default = null)
    {
        if (isset($_POST[$value])) {
            return self::sanitize($_POST[$value]);
        }
        return $default; // Hoặc bạn có thể ném ra ngoại lệ nếu muốn
    }

    // Phương thức để lấy giá trị từ $_GET
    public static function get($value, $default = null)
    {
        if (isset($_GET[$value])) {
            return self::sanitize($_GET[$value]);
        }
        return $default; // Hoặc bạn có thể ném ra ngoại lệ nếu muốn
    }

    // Phương thức để mã hóa dữ liệu tránh XSS
    private static function sanitize($value)
    {
        // Dùng htmlspecialchars để mã hóa các ký tự đặc biệt
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
