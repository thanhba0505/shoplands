<?php

namespace App\Controllers;

use App\Helpers\Response;
use App\Models\AddressModel;
use App\Helpers\Auth;
use App\Helpers\Log;

class AddressController
{
    public function userGet()
    {
        try {
            $user = Auth::user();

            $result = AddressModel::getAllByAccountId($user['account_id']);

            Response::json($result);
        } catch (\Throwable $th) {
            Log::throwable("AddressController -> userGet: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    public function find($seller_id)
    {
        try {
            $result = AddressModel::getAllBySellerId($seller_id);

            if (!$result) {
                Response::json(['message' => 'Không tìm thấy người bán'], 400);
            }

            Response::json($result);
        } catch (\Throwable $th) {
            Log::throwable("AddressController -> find: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
