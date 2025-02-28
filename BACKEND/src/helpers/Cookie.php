<?php

namespace App\Helpers;

use App\Helpers\Response;

class Cookie
{
    private static $path = "/";
    private static $domain = ""; // Có thể đặt tên miền nếu cần
    private static $secure = true; // Chỉ gửi cookie qua HTTPS
    private static $httponly = true; // Không thể truy cập cookie qua JavaScript

    // Thiết lập mặc định cho cookie
    public static function init()
    {
        self::$secure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
    }

    // Lưu cookie
    public static function set($key, $value, $expiry = 3600)
    {
        $expiryTime = time() + $expiry; // Thời gian hết hạn tính bằng giây
        return setcookie($key, $value, [
            'expires' => $expiryTime,
            'path' => self::$path,
            'domain' => self::$domain,
            'secure' => self::$secure,
            'httponly' => self::$httponly,
            'samesite' => 'Strict', // Giảm thiểu nguy cơ tấn công CSRF
        ]);
    }

    // Lấy giá trị cookie
    public static function get($key)
    {
        return $_COOKIE[$key] ?? null;
    }

    // Xóa cookie
    public static function remove($key)
    {
        return setcookie($key, '', [
            'expires' => time() - 3600, // Thời gian quá khứ để xóa
            'path' => self::$path,
            'domain' => self::$domain,
            'secure' => self::$secure,
            'httponly' => self::$httponly,
            'samesite' => 'Strict',
        ]);
    }

    // Hiển thị thông tin debug cookie
    public static function debug()
    {
        Response::json($_COOKIE);
    }
}
