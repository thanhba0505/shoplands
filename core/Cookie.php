<?php

class Cookie
{
    private $path = "/";
    private $domain = ""; // Có thể đặt tên miền nếu cần
    private $secure = true; // Chỉ gửi cookie qua HTTPS
    private $httponly = true; // Không thể truy cập cookie qua JavaScript

    public function __construct()
    {
        // Thiết lập cấu hình cookie mặc định
        $this->secure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
    }

    // Lưu cookie
    public function set($key, $value, $expiry = 3600)
    {
        $expiryTime = time() + $expiry; // Thời gian hết hạn tính bằng giây
        return setcookie($key, $value, [
            'expires' => $expiryTime,
            'path' => $this->path,
            'domain' => $this->domain,
            'secure' => $this->secure,
            'httponly' => $this->httponly,
            'samesite' => 'Strict', // Giảm thiểu nguy cơ tấn công CSRF
        ]);
    }

    // Lấy giá trị cookie
    public function get($key)
    {
        return $_COOKIE[$key] ?? null;
    }

    // Xóa cookie
    public function remove($key)
    {
        return setcookie($key, '', [
            'expires' => time() - 3600, // Thời gian quá khứ để xóa
            'path' => $this->path,
            'domain' => $this->domain,
            'secure' => $this->secure,
            'httponly' => $this->httponly,
            'samesite' => 'Strict',
        ]);
    }

    // Hiển thị thông tin debug cookie
    public function debug()
    {
        echo '<pre>';
        print_r($_COOKIE);
        echo '</pre>';
    }
}
