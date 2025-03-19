<?php

namespace App\Models;

use App\Helpers\Carbon;
use App\Helpers\Response;
use App\Models\ConnectDatabase;

class OrderModel {
    // Tạo đơn hàng
    public static function add($seller_id, $user_id, $from_address_id, $to_address_id, $shipping_fee_id, $subtotal_price, $discount, $final_price, $revenue, $coupon_id = null) {
        $query = new ConnectDatabase();

        $created_at = Carbon::now();

        $sql =  "
            INSERT INTO
                orders (seller_id, user_id, from_address_id, to_address_id, shipping_fee_id, subtotal_price, discount, final_price, revenue, coupon_id, created_at)
            VALUES
                (:seller_id, :user_id, :from_address_id, :to_address_id, :shipping_fee_id, :subtotal_price, :discount, :final_price, :revenue, :coupon_id, :created_at)
        ";

        $query->query($sql, [
            'seller_id' => $seller_id,
            'user_id' => $user_id,
            'from_address_id' => $from_address_id,
            'to_address_id' => $to_address_id,
            'shipping_fee_id' => $shipping_fee_id,
            'subtotal_price' => $subtotal_price,
            'discount' => $discount,
            'final_price' => $final_price,
            'revenue' => $revenue,
            'coupon_id' => $coupon_id,
            'created_at' => $created_at
        ]);

        $orderId = $query->getConnection()->lastInsertId();

        return $orderId > 0 ? $orderId : $orderId;
    }

    // Tìm đơn hàng theo id và user id
    public static function find($orderId, $userId) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                o.id AS order_id,
                o.seller_id,
                o.user_id,
                o.from_address_id,
                o.to_address_id,
                o.shipping_fee_id,
                o.subtotal_price,
                o.discount,
                o.final_price,
                o.paid,
                o.revenue,
                o.cancel_reason,
                o.coupon_id,
                o.created_at
            FROM
                orders o
            WHERE
                o.id = :orderId
                AND o.user_id = :userId
        ";

        $result = $query->query($sql, [
            'orderId' => $orderId,
            'userId' => $userId
        ])->fetch();

        return $result;
    }

    // Cập nhật thanh toán theo id và user id
    public static function updatePaid($orderId, $userId, $paid) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                orders
            SET
                paid = :paid
            WHERE
                id = :orderId
                AND user_id = :userId
        ";

        $result = $query->query($sql, [
            'paid' => $paid,
            'userId' => $userId,
            'orderId' => $orderId
        ]);

        return $result;
    }

    // Lấy danh sach đơn hang theo user id
    public static function getByUserId($userId) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                o.id AS order_id,
                o.seller_id,
                o.user_id,
                o.from_address_id,
                o.to_address_id,
                o.shipping_fee_id,
                o.subtotal_price,
                o.discount,
                o.final_price,
                o.paid,
                o.revenue,
                o.cancel_reason,
                o.coupon_id,
                o.created_at
            FROM
                orders o
            WHERE
                o.user_id = :userId
        ";

        $result = $query->query($sql, ['userId' => $userId])->fetchAll();

        return $result ?? [];
    }

    // Lấy danh sách đơn hàng theo selelr id
    public static function getBySellerId($seller_id) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                o.id AS order_id,
                o.seller_id,
                o.user_id,
                o.from_address_id,
                o.to_address_id,
                o.shipping_fee_id,
                o.subtotal_price,
                o.discount,
                o.final_price,
                o.paid,
                o.revenue,
                o.cancel_reason,
                o.coupon_id,
                o.created_at
            FROM
                orders o
            WHERE
                o.seller_id = :seller_id
        ";

        $result = $query->query($sql, ['seller_id' => $seller_id])->fetchAll();

        return $result ?? [];
    }
}
