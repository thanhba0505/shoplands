<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class OrderItemModel {
    // Tạo sản phẩm trong đơn hàng
    public static function add($orderId, $productVariantId, $quantity, $price) {
        $query = new ConnectDatabase();

        $sql =  "
            INSERT INTO
                order_items (order_id, product_variant_id, quantity, price)
            VALUES
                (:orderId, :productVariantId, :quantity, :price)
        ";

        $result = $query->query($sql, [
            'orderId' => $orderId,
            "productVariantId" => $productVariantId,
            "quantity" => $quantity,
            "price" => $price
        ]);

        return $result;
    }

    // Lấy danh sách sản phẩm trong đơn hàng
    public static function getByOrderId($orderId) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                oi.id AS order_item_id,
                oi.order_id,
                oi.product_variant_id,
                oi.quantity,
                oi.price
            FROM
                order_items oi
            WHERE
                oi.order_id = :orderId
        ";

        $result = $query->query($sql, [
            "orderId" => $orderId
        ])->fetchAll();

        return $result;
    }
}
