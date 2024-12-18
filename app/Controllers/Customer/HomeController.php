<?php

class HomeController
{
    public function show()
    {
        $data = [
            'title' => 'Trang chủ',
        ];

        // Render view với layout
        View::make('Customer/home', $data, 'layout/layout-primary');
    }
}
