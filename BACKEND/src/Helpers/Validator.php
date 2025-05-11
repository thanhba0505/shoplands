<?php

namespace App\Helpers;

class Validator {
    // Kiểm tra nội dung hợp lệ
    public static function isText($text, $label = "Nội dung", $min = 3, $max = 20, $allowNewLine = false) {
        // Kiểm tra chuỗi rỗng khi min = 0
        if ($min == 0 && empty($text)) {
            return true;  // Nếu min = 0 và chuỗi rỗng, coi như hợp lệ
        }

        // Đảm bảo độ dài nằm trong khoảng min-max
        $length = strlen($text);
        if ($length < $min || $length > $max) {
            return "$label phải có từ $min đến $max ký tự.";
        }

        // Biểu thức chính quy cho phép chữ cái, số, dấu cách, và ký tự đặc biệt
        $regex = '/^[\p{L}\p{N}\s\.,!?&=_\-]+$/u';

        // Nếu cho phép dấu xuống dòng, bổ sung ký tự \n vào regex
        if ($allowNewLine) {
            $regex = '/^[\p{L}\p{N}\s\.,!?&=_\-\\n]+$/u';
        }

        // Kiểm tra chuỗi với biểu thức chính quy
        if (!preg_match($regex, $text)) {
            return "$label không hợp lệ.";
        }

        return true;
    }

    // Kiểm tra họ tên hợp lệ
    public static function isName($text, $label = "Họ tên", $min = 1, $max = 50) {
        // Kiểm tra chuỗi rỗng khi min = 0
        if ($min == 0 && empty($text)) {
            return true; // Hợp lệ nếu được phép rỗng
        }

        // Đảm bảo độ dài nằm trong khoảng min-max
        $length = mb_strlen($text, 'UTF-8');
        if ($length < $min || $length > $max) {
            return "$label phải có từ $min đến $max ký tự.";
        }

        // Biểu thức chính quy: chỉ cho phép chữ cái (có dấu tiếng Việt) và khoảng trắng
        $regex = '/^[\p{L}\s]+$/u';

        // Kiểm tra chuỗi
        if (!preg_match($regex, $text)) {
            return "$label chỉ được chứa chữ cái và khoảng trắng, không có ký tự đặc biệt hay số.";
        }

        return true;
    }

    // Kiểm tra số tài khoản hợp lệ
    public static function isBankAccountNumber($accountNumber, $label = "Số tài khoản", $min = 8, $max = 16) {
        // Kiểm tra rỗng
        if (empty($accountNumber)) {
            return "$label không được để trống.";
        }

        // Kiểm tra độ dài
        $length = strlen($accountNumber);
        if ($length < $min || $length > $max) {
            return "$label phải có từ $min đến $max chữ số.";
        }

        // Kiểm tra chỉ chứa số
        if (!ctype_digit($accountNumber)) {
            return "$label chỉ được chứa chữ số.";
        }

        return true;
    }


    // Kiểm tra số điện thoại hợp lệ (Trả về true nếu hợp lệ, hoặc chuỗi lỗi nếu không hợp lệ)
    public static function isPhone($phone) {
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
    public static function formatPhone($phone, $format = '+84') {
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
    public static function isPasswordStrength($password) {
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

    public static function isNumber($number, $label = "Số", $min = null, $max = null) {
        if (!is_numeric($number)) {
            return "$label phải là số.";
        }

        if ($min !== null && $number < $min) {
            return "$label phải lớn hơn $min.";
        }

        if ($max !== null && $number > $max) {
            return "$label phải nhỏ hơn $max.";
        }

        return true;
    }
}
