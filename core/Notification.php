<?php

class Notification
{
    public static function show()
    {
        $message = Session::get('notification.message');
        $type = Session::get('notification.type') ?? 'success';

        if (empty($message)) {
            return;
        }

        // Escape nội dung để đảm bảo an toàn khi truyền vào JavaScript
        $escapedMessage = addslashes($message);
        $escapedType = addslashes($type);

        // In đoạn script để gọi showToast trên trình duyệt
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    showToast({message: '$escapedMessage', type: '$escapedType'});
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
