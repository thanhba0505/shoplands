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
                a.coin,
                a.bank_number,
                a.bank_name,
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
            $result['bank_number'] = Hash::decodeAes($result['bank_number']);
            $result['bank_name'] = Hash::decodeAes($result['bank_name']);
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
                a.coin,
                a.bank_number,
                a.bank_name,
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
            $result['bank_number'] = Hash::decodeAes($result['bank_number']);
            $result['bank_name'] = Hash::decodeAes($result['bank_name']);
        }

        return $result;
    }

    // Lấy tổng số người mua theo trang thai
    public static function countByStatus($status, $search = '') {
        $query = new ConnectDatabase();

        $status = empty($status) ? "all" : $status;

        $params = [];

        $sql = "
            SELECT
                COUNT(*) AS total
            FROM    
                accounts a
                JOIN users u ON u.account_id = a.id
        ";

        if ($status !== "all") {
            $params['status'] = $status;
            $sql .= " WHERE a.status = :status";
        }

        if ($search) {
            $params['search'] = '%' . $search . '%';
            $sql .= " AND u.name LIKE :search";
        }

        return $query->query($sql, $params)->fetch()['total'];
    }

    // Lấy danh sách người mua
    public static function getAll($status = null, $limit = 12, $page = 0, $search = '') {
        $query = new ConnectDatabase();

        $status = empty($status) ? "all" : $status;

        // Bắt đầu truy vấn cơ bản
        $sql =  "
            SELECT
                u.id AS user_id,
                u.name,
                u.avatar,
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
                JOIN users u ON u.account_id = a.id
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

        if ($search) {
            $sql .= " AND u.name LIKE :search";
            $params['search'] = '%' . $search . '%';
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

    // Cập nhật avatar
    public static function updateAvatar($user_id, $avatar) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE users
            SET avatar = :avatar
            WHERE id = :user_id
        ";

        return $query->query($sql, ['user_id' => $user_id, 'avatar' => $avatar]);
    }

    // Cập nhật tên tài khoản
    public static function updateName($user_id, $name) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE users
            SET name = :name
            WHERE id = :user_id
        ";

        return $query->query($sql, ['user_id' => $user_id, 'name' => $name]);
    }
}
