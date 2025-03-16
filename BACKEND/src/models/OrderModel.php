<?php

namespace App\Models;

use App\Helpers\Carbon;
use App\Helpers\Response;
use App\Models\ConnectDatabase;

class OrderModel {
    // Lấy danh sách danh mục
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
}
