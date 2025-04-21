<?php

namespace App\Models;

use App\Helpers\Hash;
use App\Helpers\Response;
use App\Models\ConnectDatabase;

class SellerModel {
    // Lấy seller theo account id
    public static function findById($account_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                s.id AS seller_id,
                s.store_name,
                s.owner_name,
                s.description,
                s.logo,
                s.background,
                a.id AS account_id,
                a.phone,
                a.role,
                a.coin,
                a.bank_number,
                a.bank_name,
                a.status,
                a.created_at
            FROM
                accounts a
                JOIN sellers s ON s.account_id = a.id
            WHERE
                a.id = :account_id
        ";

        $result = $query->query($sql, ['account_id' => $account_id])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
            $result['bank_number'] = Hash::decodeAes($result['bank_number']);
            $result['bank_name'] = Hash::decodeAes($result['bank_name']);
        }

        return $result;
    }

    // Lấy seller theo seller id
    public static function findBySellerId($seller_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                s.id AS seller_id,
                s.store_name,
                s.owner_name,
                s.description,
                s.logo,
                s.background,
                a.id AS account_id,
                a.phone,
                a.role,
                a.coin,
                a.bank_number,
                a.bank_name,
                a.status,
                a.created_at
            FROM
                accounts a
                JOIN sellers s ON s.account_id = a.id
            WHERE
                s.id = :seller_id
        ";

        $result = $query->query($sql, ['seller_id' => $seller_id])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
            $result['bank_number'] = Hash::decodeAes($result['bank_number']);
            $result['bank_name'] = Hash::decodeAes($result['bank_name']);
        }

        return $result;
    }

    // Lấy selelr theo cart id
    public static function findSellerByCartId($cartId) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                s.id AS seller_id,
                s.store_name,
                s.owner_name,
                s.description,
                s.logo,
                s.background,
                a.id AS account_id,
                a.phone,
                a.role,
                a.coin,
                a.bank_number,
                a.bank_name,
                a.status,
                a.created_at
            FROM
                accounts a
                JOIN sellers s ON s.account_id = a.id
                JOIN products p ON p.seller_id = s.id
                JOIN product_variants pv ON pv.product_id = p.id
                JOIN carts c ON c.product_variant_id = pv.id
            WHERE
                c.id = :cartId
        ";

        $result = $query->query($sql, ['cartId' => $cartId])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
            $result['bank_number'] = Hash::decodeAes($result['bank_number']);
            $result['bank_name'] = Hash::decodeAes($result['bank_name']);
        }

        return $result;
    }

    // Lấy seller theo product id
    public static function findSellerByProductId($productId) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                s.id AS seller_id,
                s.store_name,
                s.owner_name,
                s.description,
                s.logo,
                s.background,
                a.id AS account_id,
                a.phone,
                a.role,
                a.coin,
                a.bank_number,
                a.bank_name,
                a.status,
                a.created_at
            FROM
                accounts a
                JOIN sellers s ON s.account_id = a.id
                JOIN products p ON p.seller_id = s.id
            WHERE
                p.id = :productId
        ";

        $result = $query->query($sql, ['productId' => $productId])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
            $result['bank_number'] = Hash::decodeAes($result['bank_number']);
            $result['bank_name'] = Hash::decodeAes($result['bank_name']);
        }

        return $result;
    }

    // Lấy danh sách seller
    public static function getAll($status = null, $limit = 12, $page = 0) {
        $query = new ConnectDatabase();

        $status = empty($status) ? "all" : $status;

        // Bắt đầu truy vấn cơ bản
        $sql =  "
            SELECT
                s.id AS seller_id,
                s.store_name,
                s.owner_name,
                s.description,
                s.logo,
                s.background,
                a.id AS account_id,
                a.phone,
                a.role,
                a.coin,
                a.bank_number,
                a.bank_name,
                a.status,
                a.created_at
            FROM
                accounts a
                JOIN sellers s ON s.account_id = a.id
        ";

        $params = [
            'limit' => $limit,   // Truyền limit
            'offset' => $page * $limit // Tính offset từ page và limit
        ];

        // Thêm điều kiện cho status nếu có
        if ($status !== "all") {
            $sql .= " WHERE a.status = :status";
            $params['status'] = $status;
        }

        // Thêm LIMIT và OFFSET cho phân trang
        $sql .= " LIMIT :limit OFFSET :offset";

        // Thực hiện truy vấn
        $result = $query->query($sql, $params)->fetchAll();

        if ($result) {
            foreach ($result as $key => $value) {
                if (isset($value['phone'])) {
                    $result[$key]['phone'] = Hash::decodeAes($value['phone']);
                    $result[$key]['bank_number'] = Hash::decodeAes($value['bank_number']);
                    $result[$key]['bank_name'] = Hash::decodeAes($value['bank_name']);
                }
            }
        }

        return $result;
    }

    // Lấy tổng số người bán theo trang thai
    public static function countByStatus($status) {
        $query = new ConnectDatabase();

        $status = empty($status) ? "all" : $status;

        $params = [];

        $sql = "
            SELECT
                COUNT(*) AS total
            FROM    
                accounts a
                JOIN sellers s ON s.account_id = a.id
        ";

        if ($status !== "all") {
            $params['status'] = $status;
            $sql .= " WHERE a.status = :status";
        }

        return $query->query($sql, $params)->fetch()['total'];
    }

    // Thêm người bán
    public static function add($store_name, $owner_name, $description, $logo, $background, $account_id) {
        $conn = new ConnectDatabase();

        $sql = "
            INSERT INTO sellers (store_name, owner_name, description, logo, background, account_id)
            VALUES (:store_name, :owner_name, :description, :logo, :background, :account_id)
        ";

        $result = $conn->query($sql, [
            'store_name' => $store_name,
            'owner_name' => $owner_name,
            'description' => $description,
            'logo' => $logo,
            'background' => $background,
            'account_id' => $account_id
        ]);

        return $result;
    }
}
