<?php

namespace App\Controllers;

use App\Helpers\Response;
use App\Models\CategoryModel;

class CategoryController
{
    public function getAll()
    {
        $result = CategoryModel::getAll();

        Response::json($result);
    }
}
