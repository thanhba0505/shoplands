<?php

namespace App\Models;

use App\Helpers\Hash;
use App\Models\ConnectDatabase;

class UserModel {
    // Tìm kiếm theo account_id
    public static function findById($account_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                u.id AS user_id,
                u.name,
                u.avatar,
                a.id AS account_id,
                a.phone,
                a.role,
                a.status,
                a.created_at
            FROM
                accounts a
                JOIN users u ON u.account_id = a.id
            WHERE
                a.id = :account_id
        ";

        $result = $query->query($sql, ['account_id' => $account_id])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
        }

        return $result;
    }

    // Thêm 1 user
    public static function addUser($name, $account_id) {
        $query = new ConnectDatabase();

        $sql = "
            INSERT INTO users (name, account_id)
            VALUES (:name, :account_id)
        ";

        return $query->query($sql, ['name' => $name, 'account_id' => $account_id]);
    }

    // Tìm kiếm user theo user_id
    public static function findByUserId($user_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                u.id AS user_id,
                u.name,
                u.avatar,
                a.id AS account_id,
                a.phone,
                a.role,
                a.status,
                a.created_at
            FROM
                accounts a
                JOIN users u ON u.account_id = a.id
            WHERE
                u.id = :user_id
        ";

        $result = $query->query($sql, ['user_id' => $user_id])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
        }

        return $result;
    }
}
