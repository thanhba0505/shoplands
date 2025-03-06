<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class ProductVariantModel
{

    // Lấy danh sách variant theo product_id
    public static function getByProductId($product_id)
    {
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

    // Lấy danh sách variant theo cartId
    public static function getByCartId($cart_id)
    {
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
}
