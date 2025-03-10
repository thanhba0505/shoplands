<?php

namespace App\Controllers;

use App\Helpers\Request;
use App\Helpers\Response;
use App\Models\ProductModel;

class CouponController
{
    public function getBySellerId($seller_id)
    {
        

        Response::json($seller_id);
    }
}
