<?php

namespace App\Helpers;

class Validator
{
    public static function isText($text, $label = "Nội dung", $min = 3, $max = 20)
    {
        // Đảm bảo độ dài nằm trong khoảng min-max
        $length = strlen($text);
        if ($length < $min || $length > $max) {
            return "$label phải có từ $min đến $max ký tự.";
        }

        // Chỉ cho phép chữ cái, số và dấu gạch dưới (_)
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $text)) {
            return "Chỉ chấp nhận chữ cái, số và dấu gạch dưới (_).";
        }

        return true;
    }

    // Kiểm tra số điện thoại hợp lệ (Trả về true nếu hợp lệ, hoặc chuỗi lỗi nếu không hợp lệ)
    public static function isPhone($phone)
    {
        if (empty($phone)) {
            return "Số điện thoại không được rỗng.";
        }

        $phoneRegex = '/^(?:\+84|0)(3|5|7|8|9)\d{8}$/';

        if (!preg_match($phoneRegex, $phone)) {
            return "Số điện thoại không hợp lệ.";
        }

        return true;
    }

    // Chuyển đổi số điện thoại sang định dạng +84XXX hoặc 0XXX
    public static function formatPhone($phone, $format = '+84')
    {
        if (self::isPhone($phone) !== true) {
            return false;
        }

        if ($format === '0') {
            return preg_replace('/^\+84/', '0', $phone); // Chuyển về 0XXX
        } elseif ($format === '+84') {
            return preg_replace('/^0/', '+84', $phone); // Chuyển về +84XXX
        }

        return $phone; // Trả về số gốc nếu không có yêu cầu chuyển đổi
    }

    // Kiểm tra độ mạnh của mật khẩu
    public static function isPasswordStrength($password)
    {
        $minLength = 8;
        $hasUpperCase = preg_match('/[A-Z]/', $password); // Có chữ hoa
        $hasLowerCase = preg_match('/[a-z]/', $password); // Có chữ thường
        $hasNumbers = preg_match('/\d/', $password); // Có số
        $hasSpecialChar = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password); // Có ký tự đặc biệt

        if (strlen($password) < $minLength) {
            return "Mật khẩu phải có ít nhất 8 ký tự.";
        }

        if (!$hasUpperCase) {
            return "Mật khẩu phải chứa ít nhất một chữ hoa.";
        }

        if (!$hasLowerCase) {
            return "Mật khẩu phải chứa ít nhất một chữ thường.";
        }

        if (!$hasNumbers) {
            return "Mật khẩu phải chứa ít nhất một chữ số.";
        }

        if (!$hasSpecialChar) {
            return "Mật khẩu phải chứa ít nhất một ký tự đặc biệt.";
        }

        return true;
    }
}
