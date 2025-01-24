<?php

class Notification
{
    public static function show($duration = 3000)
    {
        $message = Session::get('notification.message');
        $type = Session::get('notification.type') ?? 'success';

        if (empty($message)) {
            return;
        }

        // Escape nội dung để đảm bảo an toàn khi truyền vào JavaScript
        $escapedMessage = addslashes($message);
        $escapedType = addslashes($type);

        // In đoạn script để gọi showNotification trên trình duyệt
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    showNotification('$escapedMessage', '$escapedType', $duration);
                });
            </script>
        ";

        // Xóa thông báo khỏi session sau khi hiển thị
        Session::remove('notification.message');
        Session::remove('notification.type');
    }


    public static function set($message, $type = "success")
    {
        Session::set('notification.message', $message);
        Session::set('notification.type', $type);
    }
}
