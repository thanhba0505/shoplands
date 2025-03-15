<?php

namespace App\Controllers;

use App\Helpers\Response;
use App\Models\AddressModel;
use App\Helpers\Auth;
use App\Helpers\Log;

class AddressController
{
    public function getAll()
    {
        try {
            $user = Auth::user();

            $result = AddressModel::getAll($user['user_id']);

            Response::json($result);
        } catch (\Throwable $th) {
            Log::throwable("Lỗi lấy danh sách địa chỉ: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    public function fineBySellerId($seller_id)
    {
        try {
            $result = AddressModel::getAllBySellerId($seller_id);

            Response::json($result);
        } catch (\Throwable $th) {
            Log::throwable("Lỗi tìm kiếm địa chỉ theo người bán: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
