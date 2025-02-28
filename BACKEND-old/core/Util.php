<?php

class Util
{

    // Array to string cho attribute HTML
    public static function arrayToAttribute($array)
    {
        $attrString = '';
        foreach ($array as $key => $val) {
            $attrString .= ' ' . $key . '="' . Util::encodeHtml($val) . '"';
        }
        return $attrString;
    }

    // Mã hóa chuỗi bằng htmlspecialchars
    public static function encodeHtml($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    // Mã hóa chuỗi bằng htmlspecialchars
    public static function nl2br($string)
    {
        $string = self::encodeHtml($string);
        return nl2br($string);
    }

    // Định dạng số thành tiền tệ (VD: 1,000,000đ)
    public static function formatCurrency($number, $currency = 'đ')
    {
        $number = self::encodeHtml($number);
        return number_format($number, 0, ',', '.') . $currency;
    }

    // Định dạng số (VD: 2.4)
    public static function formatNumber($number, $decimal = 2)
    {
        $number = self::encodeHtml($number);
        return number_format($number, $decimal, '.', '');
    }

    // Định dạng số thành 1k, 3.3k
    public static function formatNumberShort($number, $decimal = 1)
    {
        $number = self::encodeHtml($number);

        if ($number < 1000) {
            return number_format($number); // Số nhỏ hơn 1000 giữ nguyên
        }

        $units = ['k', 'M', 'B', 'T']; // Đơn vị: nghìn, triệu, tỷ, nghìn tỷ
        $unitIndex = 0;

        while ($number >= 1000 && $unitIndex < count($units)) {
            $number /= 1000;
            $unitIndex++;
        }

        return number_format($number, $decimal, '.', '') . $units[$unitIndex - 1];
    }

    // Định dạng thời gian theo định dạng tùy chỉnh
    public static function formatDateTime($date, $format = 'd/m/Y H:i:s')
    {
        $date = self::encodeHtml($date);
        $timestamp = strtotime($date);
        return date($format, $timestamp);
    }

    // Định dạng thời gian theo định dạng tùy chỉnh
    public static function formatDate($date, $format = 'd/m/Y')
    {
        $date = self::encodeHtml($date);
        $timestamp = strtotime($date);
        return date($format, $timestamp);
    }

    // Định dạng thời gian theo định dạng tùy chỉnh
    public static function formatTime($date, $format = 'H:i:s')
    {
        $date = self::encodeHtml($date);
        $timestamp = strtotime($date);
        return date($format, $timestamp);
    }

    // Tạo slug từ chuỗi (cho URL SEO)
    public static function createSlug($string)
    {
        $string = self::encodeHtml($string);
        $string = strtolower(trim($string));
        $string = preg_replace('/[^a-z0-9-]+/', '-', $string);
        $string = preg_replace('/-+/', '-', $string);
        return rtrim($string, '-');
    }

    // Xử lý khoảng cách thời gian (VD: "2 giờ trước", "1 ngày trước")
    public static function timeAgo($date)
    {
        $date = self::encodeHtml($date);
        $timestamp = strtotime($date);
        $timeAgo = time() - $timestamp;

        if ($timeAgo < 60) {
            return $timeAgo . ' giây trước';
        } elseif ($timeAgo < 3600) {
            return floor($timeAgo / 60) . ' phút trước';
        } elseif ($timeAgo < 86400) {
            return floor($timeAgo / 3600) . ' giờ trước';
        } elseif ($timeAgo < 604800) {
            return floor($timeAgo / 86400) . ' ngày trước';
        } else {
            return date('d/m/Y', $timestamp);
        }
    }

    // In ra mảng
    public static function printArray($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    // Xử lý chuỗi tìm kiếm thành sql
    public static function buildSearchCondition($search, &$params)
    {
        if (empty($search)) {
            return '';
        }

        $keywords = explode(' ', trim($search));

        $conditions = [];
        foreach ($keywords as $index => $keyword) {
            $paramKey = ":search$index";
            $conditions[] = "p.name LIKE $paramKey";
            $params[$paramKey] = "%$keyword%"; // Thay đổi trực tiếp mảng $params bên ngoài hàm
        }

        return '(' . implode(' AND ', $conditions) . ')';
    }

    // Hàm tạo QR code
    public static function generateQRCodeBase64($data)
    {
        ob_start();
        QRcode::png($data, null, QR_ECLEVEL_H, 10, 2);
        $qrCodeImage = ob_get_clean();
        return base64_encode($qrCodeImage);
    }

    // Hàm tạo và lưu QR code
    public static function saveQRCode($data, $filename)
    {
        QRcode::png($data, Asset::getQR($filename), QR_ECLEVEL_H, 10, 2);
        return Asset::getQR($filename);
    }
}
