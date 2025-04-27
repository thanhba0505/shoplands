<?php

namespace App\Models;

use App\Helpers\DataHelper;
use App\Helpers\Response;
use App\Models\ConnectDatabase;

class CartModel {
    // Lấy danh sách giỏ hàng
    public static function getAll() {
        $conn = new ConnectDatabase();

        $sql = "
            SELECT
                c.id AS cart_id,
                c.quantity AS cart_quantity,
                c.user_id,

                p.id AS product_id,
                p.name AS product_name,
                p.status,

                pv.id AS product_variant_id,
                pv.price,
                pv.promotion_price,
                pv.quantity AS product_quantity,

                s.id AS seller_id,
                s.store_name,

                pi.image_path AS image,

                pa.name AS attribute_name,
                pav.value AS attribute_value

            FROM
                carts c
                JOIN product_variants pv ON pv.id = c.product_variant_id
                JOIN products p ON p.id = pv.product_id
                JOIN sellers s ON s.id = p.seller_id
                LEFT JOIN product_images pi ON pi.product_id = p.id
                LEFT JOIN product_variant_values pvv ON pvv.product_variant_id = pv.id
                LEFT JOIN product_attribute_values pav ON pav.id = pvv.product_attribute_value_id
                LEFT JOIN product_attributes pa ON pa.id = pav.product_attribute_id
                
            WHERE
                pi.default = 1
        ";

        $result = $conn->query($sql)->fetchAll();

        $config = [
            'keep_columns' => [
                'user_id',
                'seller_id',
                'store_name',
            ],
            'group_columns' => [
                'cart_details' => [
                    'cart_id',
                    'cart_quantity',
                    'user_id',
                    'status',
                    'product_id',
                    'product_name',
                    'product_variant_id',
                    'price',
                    'promotion_price',
                    'product_quantity',
                    'image',
                    'attribute_name',
                    'attribute_value',
                ],
            ]
        ];

        $result = DataHelper::groupData($result, $config);

        foreach ($result as $key => $value) {
            $config = [
                'keep_columns' => [
                    'cart_id',
                    'quantity',
                    'user_id',
                    'status',
                    'product_variant_id',
                    'product_id',
                    'product_name',
                    'product_quantity',
                    'price',
                    'promotion_price',
                    'image',
                ],
                'group_columns' => [
                    'variant_value' => [
                        'attribute_name',
                        'attribute_value',
                    ],
                ]
            ];

            $cart_details = DataHelper::groupData($value['cart_details'], $config);

            $result[$key]['cart_details'] = $cart_details;

            foreach ($cart_details as $key2 => $value2) {
                if (count($value2['variant_value']) === 1 && $value2['variant_value'][0]['attribute_name'] == null) {
                    unset($result[$key]['cart_details'][$key2]['variant_value']);
                }
            }
        }

        return $result ?? [];
    }


    // Lấy seller có trong cart theo user id
    public static function getSellersByUserId($userId) {
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

    // Lấy seller theo cart id
    public static function findSellerByCartId($cartId) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                s.id AS seller_id,
                s.store_name
            FROM
                carts c
                JOIN product_variants pv ON pv.id = c.product_variant_id
                JOIN products p ON p.id = pv.product_id
                JOIN sellers s ON s.id = p.seller_id
            WHERE
                c.id = :cartId
        ";

        $result = $query->query($sql, ['cartId' => $cartId])->fetch();

        return $result;
    }

    // Lấy carts theo user id và seller id
    public static function getCartsByUserIdAndSellerId($userId, $sellerId) {
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
    public static function addCart($userId, $productVariantId, $quantity) {
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
    public static function updateCart($userId, $productVariantId, $quantity) {
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
    public static function deleteCart($userId, $cartId) {
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
    public static function checkCart($userId, $productVariantId) {
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

    // Lấy danh sách số lượng, giá của giỏ hàng
    public static function getQuantityAndPrice($user_id) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                c.id AS cart_id,
                c.quantity,
                c.user_id,
                pv.id AS product_variant_id,
                pv.price,
                pv.promotion_price
            FROM
                carts c
                JOIN product_variants pv ON pv.id = c.product_variant_id
                JOIN products p ON p.id = pv.product_id
                JOIN sellers s ON s.id = p.seller_id
            WHERE
                c.user_id = :user_id
        ";

        $result = $query->query($sql, ['user_id' => $user_id])->fetchAll();

        return $result ?? [];
    }

    // Xóa khỏi giỏ hàng
    public static function delete($user_id, $cart_id) {
        $query = new ConnectDatabase();

        $sql = "
            DELETE FROM
                carts
            WHERE
                id = :cart_id
                AND user_id = :user_id
        ";

        $result = $query->query($sql, ['cart_id' => $cart_id, "user_id" => $user_id]);

        return $result->rowCount() > 0 ? true : false;
    }
}
