<?php

class View
{
    // Phương thức để render view và truyền dữ liệu
    public static function make($view, $data = [])
    {
        // Kiểm tra xem view có tồn tại không
        $viewFile = './app/Views/' . $view . '.php';

        if (file_exists($viewFile)) {
            // Chuyển các biến dữ liệu thành các biến riêng lẻ
            extract($data);
            // Bao gồm file view
            require_once $viewFile;
        } else {
            echo "View not found: $view";
        }
    }
}
