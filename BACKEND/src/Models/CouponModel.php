<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class CouponModel {

    //  Mã còn hiệu lực và còn lượt sử dụng
    public static function getActiveCoupons($seller_id) {
        $query = new ConnectDatabase();

        $sql = "
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
                AND cp.usage_count < cp.usage_limit
            ORDER BY
                cp.minimum_order_value ASC
        ";

        return $query->query($sql, ['seller_id' => $seller_id])->fetchAll();
    }

    //  Mã hiện tại hoặc tương lai có thể dùng được (vẫn còn lượt sử dụng)
    public static function getUpcomingCoupons($seller_id) {
        $query = new ConnectDatabase();

        $sql = "
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
                AND cp.end_date >= NOW()
                AND cp.usage_count < cp.usage_limit
            ORDER BY
                cp.start_date ASC
        ";

        return $query->query($sql, ['seller_id' => $seller_id])->fetchAll();
    }

    //  Mã không còn sử dụng được (hết hạn hoặc hết lượt)
    public static function getExpiredCoupons($seller_id) {
        $query = new ConnectDatabase();

        $sql = "
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
                AND (
                    cp.end_date < NOW()
                    OR cp.usage_count >= cp.usage_limit
                )
            ORDER BY
                cp.end_date DESC
        ";

        return $query->query($sql, ['seller_id' => $seller_id])->fetchAll();
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
        ";

        $result = $query->query($sql, ['coupon_id' => $coupon_id, 'seller_id' => $seller_id])->fetch();

        return $result;
    }

    // Sử dụng giảm giá
    public static function useCoupon($coupon_id) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                coupons
            SET
                usage_count = usage_count + 1
            WHERE
                id = :coupon_id
                AND usage_count < usage_limit
        ";

        $result =  $query->query($sql, ['coupon_id' => $coupon_id]);

        return $result->rowCount();
    }

    // Hủy sử dụng giảm giá
    public static function cancelCoupon($coupon_id) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                coupons
            SET
                usage_count = usage_count - 1
            WHERE
                id = :coupon_id
                AND usage_count > 0
        ";

        $result =  $query->query($sql, ['coupon_id' => $coupon_id]);

        return $result->rowCount();
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
            'description' => $description ? $description : null,
            'discount_type' => $discount_type,
            'discount_value' => $discount_value,
            'maximum_discount' => $maximum_discount ? $maximum_discount : null,
            'minimum_order_value' => $minimum_order_value ? $minimum_order_value : null,
            'usage_limit' => $usage_limit ? $usage_limit : null,
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
