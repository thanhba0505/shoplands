<?php

namespace App\Controllers;

use App\Helpers\CallApi;
use App\Helpers\Carbon;
use App\Helpers\Log;
use App\Helpers\QRCode;
use App\Helpers\Response;
use App\Models\ConnectDatabase;

class Controller {
    public function getMessage() {
        try {
            $sql = file_get_contents('./src/Logs/sms.log');

            echo '<pre>';
            echo $sql;
            echo '</pre>';
            exit();
        } catch (\Throwable $th) {
            Log::throwable("Controller -> getMessage: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }


    public function getBanks() {
        try {
            $resultApi = CallApi::get("https://api.vietqr.io/v2/banks");

            $result = [];

            foreach ($resultApi["data"] as $bank) {
                $result[] = [
                    "name" => $bank["name"],
                    "code" => $bank["code"],
                    "shortName" => $bank["shortName"],
                    "logo" => $bank["logo"],
                ];
            }

            Response::json($result);
        } catch (\Throwable $th) {
            Log::throwable("Controller -> getBanks: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
