<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class ProductVariantModel {

    // Lấy danh sách variant theo product_id
    public static function getByProductId($product_id) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                pv.id AS product_variant_id,
                pv.price,
                pv.promotion_price,
                pv.quantity,
                pv.sold_quantity
            FROM
                product_variants pv
            WHERE
                pv.product_id = :product_id
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetchAll();

        return $result ?? [];
    }

    // Lấy danh sách variant theo product_variant_id
    public static function getByProductVariantId($product_variant_id) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                pv.id AS product_variant_id,
                pv.price,
                pv.promotion_price,
                pv.quantity,
                pv.sold_quantity
            FROM
                product_variants pv
            WHERE
                pv.id = :product_variant_id
        ";

        $result = $query->query($sql, ['product_variant_id' => $product_variant_id])->fetch();

        return $result ?? [];
    }

    // Lấy danh sách variant theo cartId
    public static function getByCartId($cart_id) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                pv.id AS product_variant_id,
                pv.price,
                pv.promotion_price,
                pv.quantity,
                pv.sold_quantity
            FROM
                product_variants pv
                JOIN carts c ON c.product_variant_id = pv.id
            WHERE
                c.id = :cart_id
        ";

        $result = $query->query($sql, ['cart_id' => $cart_id])->fetch();

        return $result ?? null;
    }

    // Cập nhật số lượng tồn kho và số lượng đã bán
    public static function updateQuantity($product_variant_id, $quantity_purchase) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE 
                product_variants
            SET
                quantity = quantity - :quantity_purchase,
                sold_quantity = sold_quantity + :quantity_purchase
            WHERE
                id = :product_variant_id
        ";

        $result = $query->query($sql, [
            'product_variant_id' => $product_variant_id,
            'quantity_purchase' => $quantity_purchase
        ]);

        return $result;
    }
}
