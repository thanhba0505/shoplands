<?php

require_once 'app/Models/ConnectDatabase.php';

class AdminController
{
    public function show()
    {
        $listAdmin = Other::listAdmin();

        $data = [
            'title' => 'Khuyến mãi',
            'listAdmin' => $listAdmin
        ];

        return View::make('Seller/Admin/index', $data, sidebar: 'seller');
    }

    public function apiHandleTab()
    {
        return Api::view('Seller/Admin/tab', []);
    }
}
