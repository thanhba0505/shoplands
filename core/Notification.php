<?php

class Notification
{
    public static function show($duration = 3000)
    {
        $message = Session::get('notification.message');
        $type = Session::get('notification.type') ?? 'success';

        if (empty($message) || empty($type)) {
            return;
        }

        echo "<script>document.addEventListener('DOMContentLoaded', () => {showNotification('$message', '$type', $duration);});</script>";
        Session::remove('notification.message');
        Session::remove('notification.type');
    }

    public static function set($message, $type = "success")
    {
        Session::set('notification.message', $message);
        Session::set('notification.type', $type);
    }
}
