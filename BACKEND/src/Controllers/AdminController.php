<?php

namespace App\Controllers;

use App\Helpers\Log;
use App\Helpers\Response;
use App\Models\AccountModel;

class AdminController {
  public function adminDashboard() {
    try {

      $data = AccountModel::getAdminDashboard();

      Response::json($data, 200);
    } catch (\Throwable $th) {
      Log::throwable("AdminController -> adminDashboard: " . $th->getMessage());
      Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
    }
  }
}
