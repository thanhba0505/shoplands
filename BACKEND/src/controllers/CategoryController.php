<?php

namespace App\Controllers;

use App\Helpers\Log;
use App\Helpers\Response;
use App\Models\CategoryModel;

class CategoryController {
    public function get() {
        try {
            $result = CategoryModel::getAll();

            Response::json($result);
        } catch (\Throwable $th) {
            Log::throwable("CategoryController -> get: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
