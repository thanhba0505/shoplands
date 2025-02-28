<?php

namespace App\Controllers\Customer;

class HomeController
{
    public function index()
    {
        header('Content-Type: application/json');
        echo json_encode(['success' => "home"]);
    }
}
