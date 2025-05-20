<?php

namespace App\Models;

use App\Helpers\Carbon;
use App\Helpers\Hash;
use App\Models\ConnectDatabase;

class ContactModel {
    public static function create($name, $phone, $topic, $content) {
        $conn = new ConnectDatabase();

        $phoneHash = Hash::encodeSha256($phone);
        $phone = Hash::encodeAes($phone);

        $sql = "
            INSERT INTO contact (
                name,
                phone,
                phoneHash,
                content,
                topic,
                created_at
            ) VALUES (
                :name,
                :phone,
                :phoneHash,
                :content,
                :topic,
                :created_at
            )
        ";

        $conn->query($sql, [
            'name' => $name,
            'phone' => $phone,
            'phoneHash' => $phoneHash,
            'content' => $content,
            'topic' => $topic,
            'created_at' => Carbon::now(),
        ]);

        return $conn->getConnection()->lastInsertId();
    }

    public static function getAll($limit = 10, $page = 0, $search = '') {
        $conn = new ConnectDatabase();

        $limit = (int) $limit;
        $page = (int) $page;
        $offset = $limit * $page;

        // Lấy tổng số contact
        $countSql = "SELECT COUNT(*) as total FROM contact";
        $countResult = $conn->query($countSql)->fetch();
        $totalCount = $countResult['total'];

        $params = [
            'limit' => $limit,
            'offset' => $offset
        ];

        // Lấy contact theo trang
        $dataSql = "
            SELECT 
                id,
                name,
                phone,
                topic,
                content,
                response,
                created_at
            FROM contact
        ";

        if ($search) {
            $dataSql .= " WHERE name LIKE :search";
            $params['search'] = '%' . $search . '%';
        }

        $dataSql .= "
            LIMIT :limit OFFSET :offset
        ";

        $contacts = $conn->query($dataSql, $params)->fetchAll();

        // Giải mã số điện thoại
        foreach ($contacts as $key => $value) {
            $contacts[$key]['phone'] = Hash::decodeAes($value['phone']);
        }

        return [
            'count' => $totalCount,
            'contacts' => $contacts
        ];
    }

    public static function getUnreplied($limit = 10, $page = 0, $search = '') {
        $conn = new ConnectDatabase();

        $limit = (int) $limit;
        $page = (int) $page;
        $offset = $limit * $page;

        // Lấy tổng số contact
        $countSql = "SELECT COUNT(*) as total FROM contact WHERE response IS NULL";
        $countResult = $conn->query($countSql)->fetch();
        $totalCount = $countResult['total'];

        $params = [
            'limit' => $limit,
            'offset' => $offset
        ];

        // Lấy contact theo trang
        $dataSql = "
            SELECT 
                id,
                name,
                phone,
                topic,
                content,
                response,
                created_at
            FROM contact
            WHERE response IS NULL
        ";

        if ($search) {
            $dataSql .= " AND name LIKE :search";
            $params['search'] = '%' . $search . '%';
        }

        $dataSql .= "
            LIMIT :limit OFFSET :offset
        ";

        $contacts = $conn->query($dataSql, $params)->fetchAll();

        // Giải mã số điện thoại
        foreach ($contacts as $key => $value) {
            $contacts[$key]['phone'] = Hash::decodeAes($value['phone']);
        }

        return [
            'count' => $totalCount,
            'contacts' => $contacts
        ];
    }

    public static function getReplied($limit = 10, $page = 0, $search = '') {
        $conn = new ConnectDatabase();

        $limit = (int) $limit;
        $page = (int) $page;
        $offset = $limit * $page;

        // Lấy tổng số contact
        $countSql = "SELECT COUNT(*) as total FROM contact WHERE response IS NOT NULL";
        $countResult = $conn->query($countSql)->fetch();
        $totalCount = $countResult['total'];

        $params = [
            'limit' => $limit,
            'offset' => $offset
        ];

        // Lấy contact theo trang
        $dataSql = "
            SELECT 
                id,
                name,
                phone,
                topic,
                content,
                response,
                created_at
            FROM contact
            WHERE response IS NOT NULL
        ";

        if ($search) {
            $dataSql .= " AND name LIKE :search";
            $params['search'] = '%' . $search . '%';
        }

        $dataSql .= "
            LIMIT :limit OFFSET :offset
            
        ";

        $contacts = $conn->query($dataSql, $params)->fetchAll();

        // Giải mã số điện thoại
        foreach ($contacts as $key => $value) {
            $contacts[$key]['phone'] = Hash::decodeAes($value['phone']);
        }

        return [
            'count' => $totalCount,
            'contacts' => $contacts
        ];
    }

    public static function adminReply($id, $content) {
        $conn = new ConnectDatabase();
        $sql = "
            UPDATE contact
            SET response = :content
            WHERE id = :id
        ";
        $result = $conn->query($sql, [
            'id' => $id,
            'content' => $content
        ]);

        return $result;
    }

    public static function getById($id) {
        $conn = new ConnectDatabase();
        $sql = "
            SELECT
                id,
                name,
                phone,
                topic,
                content,
                response,
                created_at
            FROM contact
            WHERE id = :id
        ";
        $result = $conn->query($sql, ['id' => $id])->fetch();

        if ($result) {
            $result['phone'] = Hash::decodeAes($result['phone']);
        }

        return $result;
    }
}
