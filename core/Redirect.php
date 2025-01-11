<?php

class Redirect
{
    public static function route($type = 'url',  $path = '', $message = '', $typeMessage = 'success')
    {
        if ($type == 'url') {
            return self::url($path);
        } else if ($type == 'to') {
            return self::to($path, $message, $typeMessage);
        } else {
            return self::url($path);
        }
    }

    public static function to($path = '', $message = '', $type = 'success')
    {
        if ($message !== '') {
            Notification::set($message, $type);
        }
        $url = self::url($path);

        header("Location: $url");
        exit();
    }

    public static function back($message = '', $type = 'success')
    {
        $referrer = $_SERVER['HTTP_REFERER'] ?? null;

        if ($referrer) {
            Notification::set($message, $type);
            header("Location: $referrer");
        } else {

            self::to('/');
        }
        exit();
    }

    public static function url($path = '')
    {
        $baseUrl = defined('BASE_URL') ? BASE_URL : 'http://' . $_SERVER['HTTP_HOST'];

        $url = rtrim($baseUrl, '/') . '/' . ltrim($path, '/');

        return $url;
    }

    public static function reload()
    {
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }

    public static function logout($type = 'url', $message = '', $typeMessage = 'success')
    {
        return self::route($type, 'logout', $message, $typeMessage);
    }

    public static function home($type = 'url', $message = '', $typeMessage = 'success')
    {
        return self::route($type, '', $message, $typeMessage);
    }

    public static function login($type = 'url', $message = '', $typeMessage = 'success')
    {
        return self::route($type, 'login', $message, $typeMessage);
    }

    public static function register($type = 'url', $message = '', $typeMessage = 'success')
    {
        return self::route($type, 'register', $message, $typeMessage);
    }

    public static function accountSettings($type = 'url', $message = '', $typeMessage = 'success')
    {
        return self::route($type, 'account-settings', $message, $typeMessage);
    }

    public static function product($type = 'url', $message = '', $typeMessage = 'success')
    {
        return self::route($type, 'products', $message, $typeMessage);
    }

    public static function post($type = 'url', $message = '', $typeMessage = 'success')
    {
        return self::route($type, 'posts', $message, $typeMessage);
    }

    public static function cart($type = 'url', $message = '', $typeMessage = 'success')
    {
        return self::route($type, 'cart', $message, $typeMessage);
    }

    public static function shop($type = 'url', $message = '', $typeMessage = 'success')
    {
        return self::route($type, 'shop', $message, $typeMessage);
    }

    public static function order($type = 'url', $message = '', $typeMessage = 'success')
    {
        return self::route($type, 'orders', $message, $typeMessage);
    }

    public static function seller($type = 'url', $message = '', $typeMessage = 'success')
    {
        return self::route($type, 'seller/orders/all', $message, $typeMessage);
    }
}
