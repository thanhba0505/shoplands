<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class CouponModel
{
    // Lấy danh sách danh mục
    public static function getAll($seller_id)
    {
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
}
