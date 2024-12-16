<?php

class HomeController
{
    public function index()
    {
        // Truyền tham số vào dữ liệu view
        $data = [
            'title' => 'Trang chủ',
            'message' => 'Chào mừng bạn đến với trang chủ!',
        ];

        // Gọi view và truyền dữ liệu vào
        View::make('Customer/home', $data);
    }
}
