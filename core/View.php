<?php

class View
{
    // Render view với layout
    public static function make($view, $data = [], $layout = null)
    {
        // Giải nén biến để có thể sử dụng trực tiếp trong view
        extract($data);

        // Lấy nội dung của view
        ob_start();
        require "./app/views/$view.php";
        $content = ob_get_clean();

        // Nếu có layout, render layout và chèn nội dung
        if ($layout) {
            require "./app/views/$layout.php";
        } else {
            // Nếu không có layout, chỉ render nội dung view
            echo $content;
        }
    }
}
