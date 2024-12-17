<?php

class Session
{
    public function __construct()
    {
        // Thiết lập các cấu hình session bảo mật
        ini_set('session.cookie_secure', true); // Chỉ gửi cookie qua HTTPS
        ini_set('session.cookie_httponly', true); // Không thể truy cập cookie qua JavaScript
        ini_set('session.use_strict_mode', true); // Chỉ chấp nhận session ID hợp lệ
        ini_set('session.use_only_cookies', true); // Không sử dụng session ID trong URL
        session_start();
    }

    // Lưu vào session
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
        return true;
    }

    // Lấy từ session
    public function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    // Xóa khỏi session
    public function remove($key)
    {
        unset($_SESSION[$key]);
        return true;
    }

    // Hủy session
    public function destroy()
    {
        session_unset();
        session_destroy();
        return true;
    }

    public function debug()
    {
        echo '<pre>';
        print_r($_SESSION);
        echo '</pre>';
    }
}
