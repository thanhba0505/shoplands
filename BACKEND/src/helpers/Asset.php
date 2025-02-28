<?php

namespace App\Helpers;

class Asset
{
    public static function url($path, $v = false)
    {
        $baseUrl = defined('BASE_URL') ? BASE_URL : 'http://' . $_SERVER['HTTP_HOST'];

        $version = $v ? '?v=' . rand() : '';

        return rtrim($baseUrl, '/') . '/src/public/' . ltrim($path, '/') . $version;
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
        return self::getImg('uploaded/avatar/' . $file_name, $v);
    }

    public static function getBackground($file_name, $v = false)
    {
        return self::getImg('uploaded/background/' . $file_name, $v);
    }

    public static function getProduct($file_name, $v = false)
    {
        return self::getImg('uploaded/product/' . $file_name, $v);
    }

    public static function getQR($file_name, $v = false)
    {
        return self::getImg('qr/' . $file_name, $v);
    }
}
