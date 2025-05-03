<?php

namespace App\Models;

use App\Helpers\Carbon;
use App\Models\ConnectDatabase;

class OrderStatusModel {

    // Thêm 1 đòng trạng thái
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

    // Tìm dòng trạng thái mới nhất
    public static function findLatest($order_id) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                os.id AS order_status_id,
                os.order_id,
                os.status,
                os.created_at
            FROM
                order_status os
            WHERE
                os.order_id = :order_id
            ORDER BY
                os.created_at DESC
            LIMIT 1
        ";

        $result = $query->query($sql, [
            'order_id' => $order_id,
        ])->fetch();

        return $result;
    }

    // Lấy danh sách trạng thái
    public static function getByOrderId($order_id) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                os.id AS order_status_id,
                os.order_id,
                os.status,
                os.created_at
            FROM
                order_status os
            WHERE
                os.order_id = :order_id
            ORDER BY
                os.created_at
        ";

        $result = $query->query($sql, ['order_id' => $order_id])->fetchAll();

        return $result ?? [];
    }
}
