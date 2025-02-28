<?php

namespace App\Controllers\Customer;

class CartController
{
    public function index()
    {
        header('Content-Type: application/json');
        echo json_encode(['success' => "cart"]);
    }
}
