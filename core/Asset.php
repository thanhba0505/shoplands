<?php

class Asset
{
    public static function url($path, $v = false)
    {
        $path = Util::encodeHtml($path);

        $baseUrl = defined('BASE_URL') ? BASE_URL : 'http://' . $_SERVER['HTTP_HOST'];

        $version = $v ? '?v=' . rand() : '';

        return rtrim($baseUrl, '/') . '/public/' . ltrim($path, '/') . $version;
    }

    public static function getImg($file_name, $v = false)
    {
        return self::url('img/' . $file_name, $v);
    }


    public static function getImgApp($file_name, $v = false)
    {
        return self::getImg('app/' . $file_name, $v);
    }

    public static function getAvatar($file_name, $v = false)
    {
        return self::getImg('uploads/avatar/' . $file_name, $v);
    }

    public static function getBackground($file_name, $v = false)
    {
        return self::getImg('uploads/background/' . $file_name, $v);
    }

    public static function getProduct($file_name, $v = false)
    {
        return self::getImg('uploads/product/' . $file_name, $v);
    }

    public static function getQR($file_name, $v = false)
    {
        return self::getImg('qr/' . $file_name, $v);
    }
}
