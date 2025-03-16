<?php

namespace App\Models;

use App\Helpers\Carbon;
use App\Models\ConnectDatabase;

class OrderStatusModel {

    // Thêm 
    public static function add($order_id, $status) {
        $query = new ConnectDatabase();

        $created_at = Carbon::now();

        $sql = "
            INSERT INTO
                order_status (order_id, status, created_at)
            VALUES
                (:order_id, :status, :created_at)
        ";

        $result = $query->query($sql, [
            'order_id' => $order_id,
            'status' => $status,
            'created_at' => $created_at
        ]);

        return $result;
    }
}
