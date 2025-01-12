<?php

class CSRF
{
    private static $tokenName = 'csrf';

    // Tạo và lưu CSRF Token
    public static function generateToken()
    {
        $token = bin2hex(random_bytes(32)); // Sinh token ngẫu nhiên
        Session::set(self::$tokenName, $token); // Lưu token vào session

        return $token;
    }

    // Xác minh CSRF Token
    public static function validateToken($token)
    {
        $sessionToken = Session::get(self::$tokenName);

        // Kiểm tra nếu session token hoặc token gửi vào là null
        if ($sessionToken === null || $token === null) {
            return false; // Nếu có bất kỳ token nào là null, trả về false
        }

        // Xóa token khỏi session sau khi sử dụng (một lần dùng)
        Session::remove(self::$tokenName);

        // So sánh token an toàn
        return hash_equals($sessionToken, $token);
    }

    // Lấy CSRF Token hiện tại 
    public static function getToken()
    {
        return Session::get(self::$tokenName) ?? null;
    }

    public static function input()
    {
        return '<input type="text" name="csrf" value="' . Util::encodeHtml(self::getToken()) . '" hidden>';
    }
}
