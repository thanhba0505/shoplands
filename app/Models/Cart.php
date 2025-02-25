<?php

require_once 'app/Models/ConnectDatabase.php';
require_once 'app/Models/QueryCustom.php';

class Cart
{
    // Lấy seller có trong cart theo user id
    public function getSellersByUserId($userId)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                s.id AS s_id,
                s.name AS s_name
            FROM
                carts c
                JOIN product_variants pv ON pv.id = c.product_variant_id
                JOIN products p ON p.id = pv.product_id
                JOIN sellers s ON s.id = p.seller_id
            WHERE
                c.user_id = :userId
        ";

        $result = $query->query($sql, ['userId' => $userId])->fetchAll();

        return $result;
    }

    // Lấy product_variant có trong cart theo seller id
    public function getProductVariandBySellerId($sellerId, $userId)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                c.id AS c_id,
                c.quantity AS c_quantity,
                pv.id AS pv_id,
                pv.price AS pv_price,
                pv.promotion_price AS pv_promotion_price,
                pv.quantity AS pv_quantity,
                pv.sold_quantity AS pv_sold_quantity,
                p.id AS p_id,
                p.name AS p_name,
                i.image_path AS i_path
            FROM
                carts c
                JOIN product_variants pv ON pv.id = c.product_variant_id
                JOIN products p ON p.id = pv.product_id
                JOIN product_images i ON i.product_id = p.id
            WHERE
                c.user_id = :userId
                AND p.seller_id = :sellerId
                AND i.default = :default
        ";

        $result = $query->query($sql, ['userId' => $userId, "sellerId" => $sellerId, "default" => '1'])->fetchAll();

        return $result;
    }

    // Lấy product_variant có trong cart theo cart id
    public function getProductVariandByCartId($cartId, $userId)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                c.id AS c_id,
                c.quantity AS c_quantity,
                pv.id AS pv_id,
                pv.price AS pv_price,
                pv.promotion_price AS pv_promotion_price,
                pv.quantity AS pv_quantity,
                pv.sold_quantity AS pv_sold_quantity,
                p.id AS p_id,
                p.name AS p_name,
                i.image_path AS i_path
            FROM
                carts c
                JOIN product_variants pv ON pv.id = c.product_variant_id
                JOIN products p ON p.id = pv.product_id
                JOIN product_images i ON i.product_id = p.id
            WHERE
                c.user_id = :userId
                AND c.id = :cartId
                AND i.default = :default
        ";

        $result = $query->query($sql, ['userId' => $userId, "cartId" => $cartId, "default" => '1'])->fetch();

        return $result;
    }

    // Kiểm tra cart đã có tồn tại
    public function checkCartByUserIdAndProductVariantId($userId, $productVariantId)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                count(*) as count
            FROM
                carts
            WHERE
                user_id = :userId
                AND product_variant_id = :productVariantId
        ";

        $result = $query->query($sql, ['userId' => $userId, "productVariantId" => $productVariantId])->fetch();

        return $result['count'] ?? 0;
    }

    // Lấy quantity cart

    public function getQuantityCartByUserIdAndProductVariantId($userId, $productVariantId)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                quantity
            FROM
                carts
            WHERE
                user_id = :userId
                AND product_variant_id = :productVariantId
        ";

        $result = $query->query($sql, ['userId' => $userId, "productVariantId" => $productVariantId])->fetch();

        return $result['quantity'] ?? 0;
    }

    // Thêm cart
    public function addCart($userId, $productVariantId, $quantity)
    {
        $query = new QueryCustom();

        $result = $query
            ->insert('carts', ['user_id' => $userId, 'product_variant_id' => $productVariantId, 'quantity' => $quantity]);

        return $result;
    }

    // Cập nhật cart
    public function updateCart($userId, $productVariantId, $quantity)
    {
        $query = new QueryCustom();

        $result = $query
            ->update(
                'carts',
                [
                    'quantity' => $quantity
                ],
                'user_id = :user_id AND product_variant_id = :product_variant_id',
                [
                    'user_id' => $userId,
                    'product_variant_id' => $productVariantId
                ]
            );

        return $result;
    }

    // Xóa cart
    public function deleteCart($userId, $cartId)
    {
        $query = new QueryCustom();

        $result = $query
            ->delete('carts', 'id = :id AND user_id = :user_id', ['user_id' => $userId, 'id' => $cartId]);

        return $result;
    }

    public function getSellerIdByCartId($cartId)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                s.id AS s_id
            FROM
                carts c
                JOIN product_variants pv ON pv.id = c.product_variant_id
                JOIN products p ON p.id = pv.product_id
                JOIN sellers s ON s.id = p.seller_id
            WHERE
                c.id = :cartId
        ";

        $result = $query->query($sql, ['cartId' => $cartId])->fetch();

        return $result['s_id'] ?? null;
    }
}
