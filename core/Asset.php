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

    public static function getImgApp($file_name, $v = false)
    {
        return self::url('img/' . $file_name, $v);
    }

    public static function getImgUpload($file_name, $v = false)
    {
        $file_name = ltrim($file_name, '/');
        return self::url('uploads/img/' . $file_name, $v);
    }

    public static function getAvatar($file_name, $v = false)
    {
        return self::getImgUpload('/avatar/' . $file_name, $v);
    }

    public static function getBackground($file_name, $v = false)
    {
        return self::getImgUpload('/background/' . $file_name, $v);
    }

    public static function getProduct($file_name, $v = false)
    {
        return self::getImgUpload('/product/' . $file_name, $v);
    }
}
