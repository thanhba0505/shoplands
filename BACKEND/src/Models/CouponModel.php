<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class CouponModel {
    // Lấy danh sách giảm giá
    public static function getAll($seller_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT DISTINCT
                cp.id AS coupon_id,
                cp.seller_id,
                cp.code,
                cp.description,
                cp.discount_type,
                cp.discount_value,
                cp.maximum_discount,
                cp.minimum_order_value,
                cp.usage_limit,
                cp.usage_count,
                cp.start_date,
                cp.end_date
            FROM
                coupons cp
            WHERE
                cp.seller_id = :seller_id 
                AND cp.start_date <= NOW()
                AND cp.end_date >= NOW()
            ORDER BY
                minimum_order_value ASC
        ";

        $result = $query->query($sql, ['seller_id' => $seller_id])->fetchAll();

        return $result;
    }

    // Tìm kiếm giảm giá
    public static function find($coupon_id, $seller_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT DISTINCT
                cp.id AS coupon_id,
                cp.seller_id,
                cp.code,
                cp.description,
                cp.discount_type,
                cp.discount_value,
                cp.maximum_discount,
                cp.minimum_order_value,
                cp.usage_limit,
                cp.usage_count,
                cp.start_date,
                cp.end_date
            FROM
                coupons cp
            WHERE
                cp.id = :coupon_id
                AND cp.seller_id = :seller_id 
                AND cp.start_date <= NOW()
                AND cp.end_date >= NOW()
        ";

        $result = $query->query($sql, ['coupon_id' => $coupon_id, 'seller_id' => $seller_id])->fetch();

        return $result;
    }

    // Thêm giảm giá
    public static function add(
        $code,
        $description,
        $discount_type,
        $discount_value,
        $maximum_discount,
        $minimum_order_value,
        $usage_limit,
        $start_date,
        $end_date,
        $seller_id
    ) {
        $conn = new ConnectDatabase();

        $sql = "
            INSERT INTO coupons (code, description, discount_type, discount_value, maximum_discount, minimum_order_value, usage_limit, start_date, end_date, seller_id)
            VALUES (:code, :description, :discount_type, :discount_value, :maximum_discount, :minimum_order_value, :usage_limit, :start_date, :end_date, :seller_id)
        ";

        $conn->query($sql, [
            'code' => $code,
            'description' => $description,
            'discount_type' => $discount_type,
            'discount_value' => $discount_value,
            'maximum_discount' => $maximum_discount,
            'minimum_order_value' => $minimum_order_value,
            'usage_limit' => $usage_limit,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'seller_id' => $seller_id
        ]);

        return $conn->getConnection()->lastInsertId();
    }

    // Kiểm tra code trùng
    public static function checkCode($code) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                *
            FROM
                coupons
            WHERE
                code = :code
        ";

        $result = $query->query($sql, ['code' => $code])->fetch();

        return $result;
    }
}
