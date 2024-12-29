<?php

class Asset
{
    public static function url($path, $v = false)
    {
        $baseUrl = defined('BASE_URL') ? BASE_URL : 'http://' . $_SERVER['HTTP_HOST'];

        $version = $v ? '?v=' . rand() : '';

        return rtrim($baseUrl, '/') . '/public/' . ltrim($path, '/') . $version;
    }
}
