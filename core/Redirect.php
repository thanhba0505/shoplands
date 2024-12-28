<?php

class Redirect
{
    // Phương thức chuyển hướng đến một URL
    public static function to($path = '', $message = '', $type = 'success')
    {
        if ($message !== '') {
            Notification::set($message, $type);
        }

        $baseUrl = defined('BASE_URL') ? BASE_URL : 'http://' . $_SERVER['HTTP_HOST']; // Lấy BASE_URL đã định nghĩa

        // Kiểm tra nếu đường dẫn không trống, tạo URL đầy đủ
        $url = rtrim($baseUrl, '/') . '/' . ltrim($path, '/');

        // Chuyển hướng (redirect) tới URL
        header("Location: $url");
        exit(); // Đảm bảo mã dừng lại ngay sau khi chuyển hướng
    }

    // Phương thức chuyển hướng về trang trước đó
    public static function back()
    {
        // Kiểm tra xem có referrer (trang trước) hay không
        $referrer = $_SERVER['HTTP_REFERER'] ?? null;

        if ($referrer) {
            header("Location: $referrer");
        } else {
            // Nếu không có referrer, chuyển hướng về trang chủ
            self::to('/');
        }
        exit();
    }
}
