<?php

namespace App\Controllers\User;

use App\Helpers\Response;

class CartController
{
    public function getAll()
    {
        $data = [
            0 => [
                'name' => 'Product 1',
                'quantity' => 1
            ],
            1 => [
                'name' => 'Product 2',
                'quantity' => 2
            ]
        ];

        Response::json($data);
    }
}
