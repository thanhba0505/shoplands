<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class ShippingFeeModel {
    // Lấy danh sách phương thức vận chuyển
    public static function getAll() {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT 
                sf.id AS shipping_fee_id,
                sf.method,
                sf.price
            FROM
                shipping_fees sf
        ";

        $result = $query->query($sql)->fetchAll();

        return $result;
    }

    // Lấy theo id
    public static function find($shipping_fee_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT 
                sf.id AS shipping_fee_id,
                sf.method,
                sf.price
            FROM
                shipping_fees sf
            WHERE
                sf.id = :shipping_fee_id
        ";

        $result = $query->query($sql, ['shipping_fee_id' => $shipping_fee_id])->fetch();

        return $result;
    }
}
