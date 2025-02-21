<?php

class Api
{
    public static function encode($data, $message = '', $status = 'success')
    {
        header('Content-Type: application/json');
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        return json_encode($response);
    }

    public static function view($view, $data = [], $status = 'success')
    {
        // Giải nén biến để có thể sử dụng trực tiếp trong view
        extract($data);

        // Lấy nội dung của view
        ob_start();
        require "./app/Views/$view.php";
        $content = ob_get_clean();

        return self::encode($content, 'Yêu cầu thành công', $status);
    }
}
