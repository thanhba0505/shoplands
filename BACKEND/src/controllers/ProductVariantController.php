<?php

namespace App\Controllers;

use App\Helpers\Request;
use App\Helpers\Response;
use App\Models\ProductModel;

class ProductVariantController
{
    public function getAll()
    {
        $limit = Request::get('limit', 12);
        $data = ProductModel::getAll($limit);

        Response::json($data);
    }
}
