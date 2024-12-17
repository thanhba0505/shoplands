<?php

class HomeController
{
    public function index()
    {
        $data = [
            'title' => 'Trang chủ',
        ];

        // Render view với layout
        View::make('Customer/home', $data, 'layout/layout-primary');
    }
}
