<?php

namespace App\Helpers;

class Validator
{
    /**
     * Kiểm tra số điện thoại hợp lệ (hỗ trợ số Việt Nam +84 và định dạng quốc tế)
     */
    public static function isPhoneNumber($phone)
    {
        return preg_match('/^(0|\+84)[1-9][0-9]{8}$/', $phone);
    }

    /**
     * Kiểm tra email hợp lệ
     */
    public static function isEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Kiểm tra độ mạnh mật khẩu
     * Yêu cầu: Ít nhất 8 ký tự, có chữ hoa, chữ thường, số và ký tự đặc biệt
     */
    public static function isStrongPassword($password)
    {
        return preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password);
    }

    /**
     * Kiểm tra độ dài chuỗi
     */
    public static function isLengthValid($string, $min = 1, $max = 255)
    {
        $length = strlen($string);
        return $length >= $min && $length <= $max;
    }

    /**
     * Kiểm tra giá trị có phải số và nằm trong khoảng min-max
     */
    public static function isNumberInRange($number, $min, $max)
    {
        return is_numeric($number) && $number >= $min && $number <= $max;
    }
}
