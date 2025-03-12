<?php

namespace App\Controllers;

use App\Helpers\Response;
use App\Models\AddressModel;
use App\Helpers\Auth;

class AddressController
{
    public function getAll()
    {
        $user = Auth::user();

        $result = AddressModel::getAll($user['user_id']);

        Response::json($result);
    }

    public function fineBySellerId($seller_id){
        $user = Auth::user();

        $result = AddressModel::getAll($user['user_id']);

        Response::json($result);
    }
}
