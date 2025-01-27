<?php

class View
{
    // Render view với layout
    public static function make($view, $data = [], $header = 'main', $sidebar = null, $footer = 'main')
    {
        // Giải nén biến để có thể sử dụng trực tiếp trong view
        extract($data);

        // Lấy nội dung của view
        ob_start();
        require "./app/Views/$view.php";
        $content = ob_get_clean();

        // Header
        $header = self::loadPartial("header/$header", $data);

        // Sidebar
        $sidebar = self::loadPartial("sidebar/$sidebar", $data);

        // Footer
        $footer = self::loadPartial("footer/$footer", $data);

        // Render template chính
        ob_start();
        require "./app/Views/layout/index.php";
        return ob_get_clean();
    }


    // Hàm hỗ trợ load từng phần (header, sidebar, footer)
    private static function loadPartial($path, $data = [])
    {
        $filePath = "./app/Views/layout/$path.php";
        if (file_exists($filePath)) {
            extract($data); // Giải nén dữ liệu để sử dụng trong partial
            ob_start();
            include $filePath;
            return ob_get_clean();
        }
        return ''; // Trả về chuỗi trống nếu file không tồn tại
    }
}
