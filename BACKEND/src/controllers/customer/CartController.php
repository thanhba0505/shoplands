<?php

namespace App\Controllers\Customer;

use App\Helpers\Asset;
use App\Helpers\Request;

class CartController
{
    public function index()
    {
        $v = Request::get('v');


        header('Content-Type: application/json');
        echo json_encode(['success' => $v, 'data' => Asset::getImgApp('mini-logo.png')]);
    }
}
