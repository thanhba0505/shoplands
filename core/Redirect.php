<?php

class Redirect
{
    protected $path;
    protected $message;
    protected $type;
    protected $queryParams = [];

    private function __construct($path = '', $message = '', $type = 'success')
    {
        $this->path = Util::encodeHtml($path); // Mã hóa đường dẫn
        $this->message = $message; // Thông báo không cần encode ở đây
        $this->type = $type;
    }

    public static function to($path = '/')
    {
        return new self(Util::encodeHtml($path)); // Mã hóa khi tạo instance
    }

    public static function back()
    {
        $referrer = $_SERVER['HTTP_REFERER'] ?? '/';
        return new self(Util::encodeHtml($referrer)); // Mã hóa referrer
    }

    public function withQuery(array $params)
    {
        foreach ($params as $key => $value) {
            // Mã hóa từng cặp key-value trong query
            $this->queryParams[Util::encodeHtml($key)] = Util::encodeHtml($value);
        }
        return $this;
    }

    public static function fullUrl($path = '', array $queryParams = [])
    {
        // Kiểm tra nếu $path đã là URL đầy đủ
        if (preg_match('/^(http|https):\/\//', $path)) {
            $url = $path;
        } else {
            $baseUrl = defined('BASE_URL') ? BASE_URL : 'http://' . $_SERVER['HTTP_HOST'];
            $url = rtrim($baseUrl, '/') . '/' . ltrim(Util::encodeHtml($path), '/');
        }

        if (!empty($queryParams)) {
            $queryParams = array_map('Util::encodeHtml', $queryParams);
            $url .= '?' . http_build_query($queryParams);
        }

        return $url;
    }

    // Trả về URL của đối tượng hiện tại
    public function getUrl()
    {
        return self::fullUrl($this->path, $this->queryParams);
    }

    // Đặt thông báo cho redirect
    public function notification($message, $type = 'success')
    {
        $this->message = $message;
        $this->type = $type;
        Notification::set($message, $type);
        return $this;
    }

    // Thực hiện chuyển hướng
    public function redirect()
    {
        if (!empty($this->message)) {
            Notification::set($this->message, $this->type);
        }

        header("Location: " . $this->getUrl());
        exit();
    }

    // Shortcut với tham số động
    public static function home($action = '')
    {
        return new self(trim('/' . $action, '/'));
    }

    public static function login($action = '')
    {
        return new self(trim('login/' . $action, '/'));
    }

    public static function logout($action = '')
    {
        return new self(trim('logout/' . $action, '/'));
    }

    public static function register($action = '')
    {
        return new self(trim('register/' . $action, '/'));
    }

    public static function cart($action = '')
    {
        return new self(trim('cart/' . $action, '/'));
    }

    public static function order($action = '')
    {
        return new self(trim('order/' . $action, '/'));
    }

    public static function shop($action = '')
    {
        return new self(trim('shop/' . $action, '/'));
    }

    public static function post($action = '')
    {
        return new self(trim('post/' . $action, '/'));
    }

    public static function product($action = '')
    {
        return new self(trim('product/' . $action, '/'));
    }

    public static function seller($action = 'order')
    {
        return new self(trim('seller/' . $action, '/'));
    }

    public static function accountSettings($action = '')
    {
        return new self(trim('account-setting/' . $action, '/'));
    }

    // Tải lại trang hiện tại
    public static function reload()
    {
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}
