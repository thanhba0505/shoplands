<?php

class Session
{
    // Thiết lập session bảo mật
    public static function init()
    {
        ini_set('session.cookie_secure', true); // Chỉ gửi cookie qua HTTPS
        ini_set('session.cookie_httponly', true); // Không thể truy cập cookie qua JavaScript
        ini_set('session.use_strict_mode', true); // Chỉ chấp nhận session ID hợp lệ
        ini_set('session.use_only_cookies', true); // Không sử dụng session ID trong URL

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Lưu vào session
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
        return true;
    }

    // Lấy từ session
    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    // Xóa khỏi session
    public static function remove($key)
    {
        unset($_SESSION[$key]);
        return true;
    }

    // Hủy session
    public static function destroy()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }
        return true;
    }

    // Hiển thị thông tin session để debug
    public static function debug()
    {
        echo '<pre>';
        print_r($_SESSION);
        echo '</pre>';
    }
}
