<?php

class Api
{
    public static function encode($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        $response = [
            'status' => $statusCode == 200 || $statusCode == 201 ? 'success' : 'error',
            'data' => $data
        ];
        return json_encode($response);
    }

    public static function view($view, $data = [], $statusCode = 200)
    {
        // Giải nén biến để có thể sử dụng trực tiếp trong view
        extract($data);

        // Lấy nội dung của view
        ob_start();
        require "./app/Views/$view.php";
        $content = ob_get_clean();

        return self::encode($content, $statusCode);
    }
}
