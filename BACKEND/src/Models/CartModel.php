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
                s.id AS seller_id,
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

    // Lấy carts theo user id và seller id
    public static function getCartsByUserIdAndSellerId($userId, $sellerId)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT DISTINCT
                c.id AS cart_id,
                c.quantity
            FROM
                carts c
                JOIN product_variants pv ON pv.id = c.product_variant_id
                JOIN products p ON p.id = pv.product_id
            WHERE
                c.user_id = :userId
                AND p.seller_id = :sellerId
        ";

        $result = $query->query($sql, ['userId' => $userId, "sellerId" => $sellerId])->fetchAll();

        return $result ?? [];
    }

    // Thêm vào giỏ hàng
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

    // Cập nhật giỏ hàng
    public static function updateCart($userId, $productVariantId, $quantity)
    {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                carts c
            SET
                c.quantity = :quantity
            WHERE
                c.user_id = :userId
                AND c.product_variant_id = :productVariantId
        ";

        $result = $query->query($sql, ['quantity' => $quantity, "userId" => $userId, "productVariantId" => $productVariantId]);

        return $result->rowCount() > 0 ? true : false;
    }

    // Xóa khỏi giỏ hàng
    public static function deleteCart($userId, $cartId)
    {
        $query = new ConnectDatabase();

        // Sửa lại câu lệnh SQL
        $sql = "
            DELETE FROM
                carts
            WHERE
                id = :cartId
                AND user_id = :userId
        ";

        $result = $query->query($sql, ['cartId' => $cartId, "userId" => $userId]);

        return $result->rowCount() > 0 ? true : false;
    }


    // Kiểm tra carts theo user id và product variant id
    public static function checkCart($userId, $productVariantId)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                c.id AS cart_id,
                c.quantity
            FROM
                carts c
            WHERE
                c.user_id = :userId
                AND c.product_variant_id = :productVariantId
        ";

        $result = $query->query($sql, ['userId' => $userId, "productVariantId" => $productVariantId])->fetch();

        return $result ?? false;
    }
}
