<?php

namespace App\Controllers;

use App\Helpers\Carbon;
use App\Helpers\QRCode;
use App\Helpers\Response;
use App\Models\ConnectDatabase;

class Controller
{
    public function sql()
    {
        // $conn = new ConnectDatabase();
        // $sql = file_get_contents('.sql');
        // $result = $conn->query($sql)->fetchAll();

        $paymentLink = 'bạn huy nói chuyện coi';
        $fileName = 'payment_qr' . rand(1000, 9999);
        $qrPaymentPath = QRCode::createPayment($paymentLink, $fileName);


        Response::json($qrPaymentPath);
    }
}
