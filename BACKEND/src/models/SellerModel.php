<?php

namespace App\Models;

use App\Helpers\Hash;
use App\Models\ConnectDatabase;

class SellerModel
{
    public static function findById($id)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                s.id AS seller_id,
                s.store_name,
                s.owner_name,
                s.bank_name,
                s.bank_number,
                s.status,
                s.description,
                s.logo,
                s.background,
                a.id AS account_id,
                a.phone,
                a.role,
                a.status,
                a.created_at
            FROM
                accounts a
                JOIN sellers s ON s.account_id = a.id
            WHERE
                a.id = :id
        ";

        $result = $query->query($sql, ['id' => $id])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
        }

        return $result;
    }
}
