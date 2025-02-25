<?php

require_once 'app/Models/ConnectDatabase.php';

class Coupon
{
// Lấy danh sách coupon theo seller id
    public function getCouponBySellerId($sellerId)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT DISTINCT
                cp.id AS cp_id,
                cp.code AS cp_code,
                cp.description AS cp_description,
                cp.discount_type AS cp_discount_type,
                cp.discount_value AS cp_discount_value,
                cp.maximum_discount AS cp_maximum_discount,
                cp.minimum_order_value AS cp_minimum_order_value,
                cp.usage_limit AS cp_usage_limit,
                cp.usage_count AS cp_usage_count,
                cp.start_date AS cp_start_date,
                cp.end_date AS cp_end_date
            FROM
                coupons cp
            WHERE
                cp.seller_id = :sellerId
        ";

        $result = $query->query($sql, ['sellerId' => $sellerId])->fetchAll();

        return $result;
    }
}
