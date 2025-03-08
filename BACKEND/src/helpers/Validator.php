<?php

namespace App\Helpers;

class Validator
{
    // Kiểm tra số điện thoại (Hỗ trợ định dạng VN: +84 hoặc 0)
    public static function isPhone($phone, $format = 'default')
    {
        $phoneRegex = '/^(?:\+84|0)(3|5|7|8|9)\d{8}$/';

        if (!preg_match($phoneRegex, $phone)) {
            return false; // Trả về false nếu không đúng định dạng số VN
        }

        // Chuẩn hóa số điện thoại về dạng +84 hoặc 0 tùy yêu cầu
        if ($format === '0') {
            // Chuyển về định dạng 0XXX
            return preg_replace('/^\+84/', '0', $phone);
        } elseif ($format === '+84') {
            // Chuyển về định dạng +84XXX
            return preg_replace('/^0/', '+84', $phone);
        }

        // Giữ nguyên số nếu không có yêu cầu chuyển đổi
        return $phone;
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
