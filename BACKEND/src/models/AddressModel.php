<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class AddressModel
{
    // Lấy danh sách địa chỉ theo user id
    public static function getAll($user_id)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT DISTINCT
                a.id AS address_id,
                a.address_line,
                a.default,
                a.seller_id,
                a.user_id,
                p.name,
                p.id AS province_id
            FROM
                addresses a
                JOIN provinces p ON p.id = a.province_id
            WHERE
                a.user_id = :user_id
                AND a.default = :default
        ";

        $result = $query->query($sql, ['user_id' => $user_id, "default" => '1'])->fetchAll();

        return $result;
    }

    // Lấy danh sách địa chỉ theo seller_id
    public static function fineBySellerId($seller_id)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT DISTINCT
                a.id AS address_id,
                a.address_line,
                a.default,
                a.seller_id,
                a.user_id,
                p.name,
                p.id AS province_id
            FROM
                addresses a
                JOIN provinces p ON p.id = a.province_id
            WHERE
                a.seller_id = :seller_id
                AND a.default = :default
        ";

        $result = $query->query($sql, ['seller_id' => $seller_id, "default" => '1'])->fetch();

        return $result;
    }
}
