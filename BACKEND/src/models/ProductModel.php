<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class ProductModel {
    // Lấy danh sách sản phẩm
    public static function getAll($limit = 12) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                p.id AS product_id,
                p.name,
                p.description,
                p.status,
                p.seller_id
            FROM
                products p
            WHERE
                p.status = :status
            LIMIT 
                $limit
        ";

        $result = $query->query($sql, ['status' => 'active'])->fetchAll();

        return $result ?? [];
    }

    // Lấy thông tin sản phẩm theo product_id
    public static function getByProductId($product_id) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                p.id AS product_id,
                p.name,
                p.description,
                p.status,
                p.seller_id
            FROM
                products p
            WHERE
                p.status = :status
                AND p.id = :product_id
        ";

        $result = $query->query($sql, ['status' => 'active', 'product_id' => $product_id])->fetch();

        return $result ?? null;
    }

    // Lấy thông tin sản phẩm theo cart_id
    public static function getByCartId($cart_id) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                p.id AS product_id,
                p.name
            FROM
                products p
                JOIN product_variants pv ON pv.product_id = p.id
                JOIN carts c ON c.product_variant_id = pv.id
            WHERE
                p.status = :status
                AND c.id = :cart_id
        ";

        $result = $query->query($sql, ['status' => 'active', 'cart_id' => $cart_id])->fetch();

        return $result ?? null;
    }

    // Lấy thông tin sản phẩm theo product_variant_id
    public static function getByProductVariantId($product_variant_id) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                p.id AS product_id,
                p.name,
                p.description,
                p.status,
                p.seller_id
            FROM
                products p
                JOIN product_variants pv ON pv.product_id = p.id
            WHERE
                p.status = :status
                AND pv.id = :product_variant_id
        ";

        $result = $query->query($sql, ['status' => 'active', 'product_variant_id' => $product_variant_id])->fetch();

        return $result ?? null;
    }
}
