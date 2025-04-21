<?php

namespace App\Controllers;

use App\Helpers\CallApi;
use App\Helpers\Carbon;
use App\Helpers\Log;
use App\Helpers\QRCode;
use App\Helpers\Response;
use App\Models\ConnectDatabase;

class Controller {
    public function sql() {
        $conn = new ConnectDatabase();
        $sql = file_get_contents('.sql');
        $result = $conn->query($sql)->fetchAll();

        // $paymentLink = 'bạn huy nói chuyện coi';
        // $fileName = 'payment_qr' . rand(1000, 9999);
        // $qrPaymentPath = QRCode::createPayment($paymentLink, $fileName);


        Response::json($result, 200);
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
