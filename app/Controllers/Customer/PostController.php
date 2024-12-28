<?php

class PostController
{
    public function show()
    {
        $cookie = new Cookie();

        $cookie->debug();

        $message = 'message';
        $messageType = 'info';
        // echo "<script>document.addEventListener('DOMContentLoaded', () => {showNotification('Xin chào!');});</script>";
        // Session::debug();
        // Session::get('csrf');
        Notification::set($message, $messageType);

        echo CSRF::getToken();
        echo '<br>';
        echo CSRF::validateToken(CSRF::getToken()) ? 'true' : 'false';

        echo CSRF::getToken();
        echo '<br>';

        // $data = [
        //     'title' => 'Post Page',
        // ];

        // View::make('Customer/post', $data, 'layout/layout-primary');
        echo '<h1>Post Page</h1>';
    }
}
