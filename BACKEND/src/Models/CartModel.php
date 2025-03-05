<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class CartModel
{
    // Lấy seller có trong cart theo user id
    public static function getSellersByUserId($userId)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT DISTINCT
                s.id,
                s.store_name
            FROM
                carts c
                JOIN product_variants pv ON pv.id = c.product_variant_id
                JOIN products p ON p.id = pv.product_id
                JOIN sellers s ON s.id = p.seller_id
            WHERE
                c.user_id = :userId
        ";

        $result = $query->query($sql, ['userId' => $userId])->fetchAll();

        return $result ?? [];
    }

    public static function addCart($userId, $productVariantId, $quantity)
    {
        $query = new ConnectDatabase(); 

        $sql = "
            INSERT INTO
                carts (user_id, product_variant_id, quantity)
            VALUES
                (:userId, :productVariantId, :quantity)
        ";

        $result = $query->query($sql, ['userId' => $userId, "productVariantId" => $productVariantId, "quantity" => $quantity]);

        return $result ? true : false;
    }
}
