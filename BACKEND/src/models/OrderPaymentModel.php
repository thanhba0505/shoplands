<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class OrderPaymentModel {
    // Thêm hoặc cập nhật thanh toán
    public static function insertOrUpdate($vnp_txnref, $vnp_code, $vnp_message, $vnp_json) {
        $query = new ConnectDatabase();

        $sql =  "
            INSERT INTO
                order_payments (vnp_code, vnp_message, vnp_json, vnp_txnref)
            VALUES
                (:vnp_code, :vnp_message, :vnp_json, :vnp_txnref)
            ON DUPLICATE KEY UPDATE
                vnp_code = VALUES(vnp_code),
                vnp_message = VALUES(vnp_message),
                vnp_json = VALUES(vnp_json)
        ";

        $result = $query->query($sql, [
            'vnp_code' => $vnp_code,
            'vnp_message' => $vnp_message,
            'vnp_json' => $vnp_json,
            'vnp_txnref' => $vnp_txnref
        ]);

        return $result->rowCount() > 0 ? true : false;
    }
}
