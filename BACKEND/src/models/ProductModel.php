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

    // Lấy danh sách sản phẩm theo seller
    public static function getBySellerId($seller_id, $status = 'all', $limit = 12, $page = 1) {
        $query = new ConnectDatabase();

        $offset = ($page - 1) * $limit;

        // Xác định phần điều kiện status
        $statusCondition = $status !== 'all' ? "AND p.status = :status" : "";

        // Tạo mảng params chứa các tham số sẽ truyền vào query
        $params = [
            'seller_id' => $seller_id,
            'limit' => $limit,
            'offset' => $offset
        ];

        // Nếu status không phải 'all', thêm tham số status vào mảng params
        if ($status !== 'all') {
            $params['status'] = $status;
        }

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
                p.seller_id = :seller_id
                $statusCondition
            LIMIT 
                :limit OFFSET :offset
        ";

        // Thực hiện truy vấn với các tham số
        $result = $query->query($sql, $params)->fetchAll();

        return $result ?? [];
    }



    // Đếm sản phẩm theo seller
    public static function countBySellerId($seller_id, $status = 'all') {
        $query = new ConnectDatabase();

        // Tạo điều kiện cho status
        $statusCondition = $status !== 'all' ? "AND p.status = :status" : "";

        // Tạo mảng params chứa các tham số truyền vào query
        $params = [
            'seller_id' => $seller_id
        ];

        // Nếu status không phải là 'all', thêm tham số status vào mảng params
        if ($status !== 'all') {
            $params['status'] = $status;
        }

        $sql = "
            SELECT
                COUNT(*) AS total
            FROM
                products p
            WHERE
                p.seller_id = :seller_id
                $statusCondition
        ";

        // Thực hiện truy vấn với các tham số
        $result = $query->query($sql, $params)->fetch();

        return $result['total'] ?? 0;
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
