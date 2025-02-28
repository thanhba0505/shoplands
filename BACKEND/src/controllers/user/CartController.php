<?php

namespace App\Controllers\User;

use App\Helpers\Response;

class CartController
{
    public function getAll()
    {
        $data = [];

        Response::json([
            'success' => true,
            'data' => $data
        ]);
    }
}
