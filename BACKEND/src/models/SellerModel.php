<?php

namespace App\Models;

use App\Helpers\Hash;
use App\Models\ConnectDatabase;

class SellerModel
{
    // Lấy seller theo account id
    public static function findById($account_id)
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
                a.id = :account_id
        ";

        $result = $query->query($sql, ['account_id' => $account_id])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
        }

        return $result;
    }

    // Lấy seller theo seller id
    public static function findBySellerId($seller_id)
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
                s.id = :seller_id
        ";

        $result = $query->query($sql, ['seller_id' => $seller_id])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
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
                JOIN products p ON p.seller_id = s.id
                JOIN product_variants pv ON pv.product_id = p.id
                JOIN carts c ON c.product_variant_id = pv.id
            WHERE
                c.id = :cartId
        ";

        $result = $query->query($sql, ['cartId' => $cartId])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
        }

        return $result;
    }
}
