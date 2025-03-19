<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class AddressModel {
    // Lấy danh sách địa chỉ theo account_id
    public static function getAllByAccountId($account_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT DISTINCT
                a.id AS address_id,
                a.address_line,
                a.default,
                a.account_id,
                p.name AS province_name,
                p.id AS province_id
            FROM
                addresses a
                JOIN provinces p ON p.id = a.province_id
            WHERE
                a.account_id = :account_id
        ";

        $result = $query->query($sql, ['account_id' => $account_id])->fetchAll();

        return $result;
    }

    // Lấy danh sách địa chỉ theo seller_id
    public static function getAllBySellerId($seller_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT DISTINCT
                a.id AS address_id,
                a.address_line,
                a.default,
                a.account_id,
                p.name AS province_name,
                p.id AS province_id
            FROM
                addresses a
                JOIN provinces p ON p.id = a.province_id
                JOIN sellers s ON s.id = a.account_id
            WHERE
                s.id = :seller_id
        ";

        $result = $query->query($sql, ['seller_id' => $seller_id])->fetchAll();

        return $result;
    }

    // Lấy địa chỉ mặc định theo account_id
    public static function findDefault($account_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT DISTINCT
                a.id AS address_id,
                a.address_line,
                a.default,
                a.account_id,
                p.name AS province_name,
                p.id AS province_id
            FROM
                addresses a
                JOIN provinces p ON p.id = a.province_id
            WHERE
                a.account_id, = :account_id,
                AND a.default = :default
        ";

        $result = $query->query($sql, ['account_id,' => $account_id, "default" => '1'])->fetch();

        return $result;
    }

    // Lấy địa chỉ mặc định theo seller_id
    public static function findDefaultBySellerId($seller_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT DISTINCT
                a.id AS address_id,
                a.address_line,
                a.default,
                a.account_id,
                p.name AS province_name,
                p.id AS province_id
            FROM
                addresses a
                JOIN provinces p ON p.id = a.province_id
                JOIN sellers s ON s.id = a.account_id
            WHERE
                s.id = :seller_id
                AND a.default = :default
        ";

        $result = $query->query($sql, ['seller_id' => $seller_id, "default" => '1'])->fetch();

        return $result;
    }

    // Lấy địa chỉ mặc định người bán theo id và seller_id
    public static function findFromAddress($seller_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT 
                a.id AS address_id,
                a.address_line,
                a.default,
                a.account_id,
                p.name AS province_name,
                p.id AS province_id
            FROM
                addresses a
                JOIN provinces p ON p.id = a.province_id
                JOIN sellers s ON s.account_id = a.account_id
            WHERE
                s.id = :seller_id
                AND a.default = :default
        ";

        $result = $query->query($sql, ['seller_id' => $seller_id, "default" => '1'])->fetch();

        return $result;
    }

    // Lấy địa chỉ người mua
    public static function findToAddress($address_id, $user_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT 
                a.id AS address_id,
                a.address_line,
                a.default,
                a.account_id,
                p.name AS province_name,
                p.id AS province_id
            FROM
                addresses a
                JOIN provinces p ON p.id = a.province_id
                JOIN users u ON u.account_id = a.account_id
            WHERE
                a.id = :address_id
                AND u.id = :user_id
        ";

        $result = $query->query($sql, ['address_id' => $address_id, 'user_id' => $user_id])->fetch();

        return $result;
    }

    // Lấy địa chỉ người bán
    public static function findSellerAddress($address_id, $seller_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT 
                a.id AS address_id,
                a.address_line,
                a.default,
                a.account_id,
                p.name AS province_name,
                p.id AS province_id
            FROM
                addresses a
                JOIN provinces p ON p.id = a.province_id
                JOIN sellers s ON s.account_id = a.account_id
            WHERE
                a.id = :address_id
                AND s.id = :seller_id
        ";

        $result = $query->query($sql, ['address_id' => $address_id, 'seller_id' => $seller_id])->fetch();

        return $result;
    }
}
