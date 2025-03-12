<?php

namespace App\Controllers;

use App\Helpers\Response;
use App\Models\CouponModel;

class CouponController
{
    public function getBySellerId($seller_id)
    {
        if (!$seller_id) {
            Response::json(['message'=>"Mã người bán rỗng"]);
        }

        $result = CouponModel::getAll($seller_id);

        Response::json($result);
    }
}
