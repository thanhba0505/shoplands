<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class UserModel
{
    public static function findById($id)
    {
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
                a.id = :id
        ";

        $result = $query->query($sql, ['id' => $id])->fetch();

        return $result;
    }
}
