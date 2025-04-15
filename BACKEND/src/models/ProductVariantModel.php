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
    public static function updateQuantity($product_variant_id, $quantity, $sold_quantity) {
        $conn = new ConnectDatabase();

        $sql = "
            UPDATE 
                product_variants
            SET
                quantity = :quantity,
                sold_quantity = :sold_quantity
            WHERE
                id = :product_variant_id
        ";

        $result = $conn->query($sql, [
            'quantity' => $quantity,
            'sold_quantity' => $sold_quantity,
            'product_variant_id' => $product_variant_id
        ]);

        return $result;
    }

    // Cập nhật số lượng tồn kho và số lượng đã bán khi hủy đơn hàng
    public static function updateQuantityWhenDeleteOrder($product_variant_id, $quantity) {
        $conn = new ConnectDatabase();

        $sql = "
            UPDATE 
                product_variants
            SET
                quantity = quantity + :quantity1,
                sold_quantity = sold_quantity - :quantity2
            WHERE
                id = :product_variant_id
        ";

        $result = $conn->query($sql, [
            'quantity1' => $quantity,
            'quantity2' => $quantity,
            'product_variant_id' => $product_variant_id
        ]);

        return $result;
    }

    // Thêm 1 sản phẩm
    public static function add($product_id, $quantity, $price, $promotion_price = null) {
        $conn = new ConnectDatabase();

        $promotion_price = $promotion_price === 0 ? null : $promotion_price;

        $sql = "
            INSERT INTO
                product_variants (product_id, quantity, price, promotion_price)
            VALUES
                (:product_id, :quantity, :price, :promotion_price)
        ";

        $conn->query($sql, [
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $price,
            'promotion_price' => $promotion_price
        ]);

        return $conn->getConnection()->lastInsertId();
    }

    // Lấy 1 variant theo product_variant_id
    public static function find($product_variant_id) {
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

        return $result ?? null;
    }

    // Cập nhật variant
    public static function updateVariant($product_variant_id, $price, $promotion_price, $quantity) {
        $conn = new ConnectDatabase();

        $promotion_price = empty($promotion_price) ? null : $promotion_price;

        $sql = "
            UPDATE 
                product_variants
            SET
                price = :price,
                promotion_price = :promotion_price,
                quantity = :quantity
            WHERE
                id = :product_variant_id
        ";

        $result = $conn->query($sql, [
            'price' => $price,
            'promotion_price' => $promotion_price,
            'quantity' => $quantity,
            'product_variant_id' => $product_variant_id
        ]);

        return $result;
    }
}
