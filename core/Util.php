<?php

class Util
{
    // Mã hóa chuỗi bằng htmlspecialchars
    public static function encodeHtml($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    // Định dạng số thành tiền tệ (VD: 1.000.000 Vn₫)
    public static function formatCurrency($number, $currency = ' Vn₫')
    {
        return number_format($number, 0, '.', ',') . $currency;
    }

    // Định dạng thời gian theo định dạng tùy chỉnh
    public static function formatDate($date, $format = 'd/m/Y H:i:s')
    {
        $timestamp = strtotime($date);
        return date($format, $timestamp);
    }

    // Định dạng thời gian theo d/m/Y
    public static function formatToDMY($date)
    {
        $timestamp = strtotime($date);
        return date('d/m/Y', $timestamp);
    }

    // Tạo slug từ chuỗi (cho URL SEO)
    public static function createSlug($string)
    {
        $string = strtolower(trim($string));
        $string = preg_replace('/[^a-z0-9-]+/', '-', $string);
        $string = preg_replace('/-+/', '-', $string);
        return rtrim($string, '-');
    }

    // Xử lý khoảng cách thời gian (VD: "2 giờ trước", "1 ngày trước")
    public static function timeAgo($date)
    {
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
}
