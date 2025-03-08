<?php

namespace App\Models;

use App\Helpers\Carbon;
use App\Helpers\Hash;
use App\Helpers\Response;
use App\Models\ConnectDatabase;

class AccountModel
{
    public static function findById($id)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                c.id as account_id,
                c.phone,
                c.password,
                c.role,
                c.status,
                c.created_at,
                c.access_token,
                c.refresh_token
            FROM
                accounts c
            WHERE
                c.id = :id
        ";

        $result = $query->query($sql, ['id' => $id])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
        }

        return $result;
    }

    public static function findByPhone($phone)
    {
        $phone = Hash::encodeSha256($phone);

        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                c.id as account_id,
                c.phone,
                c.password,
                c.role,
                c.status,
                c.created_at,
                c.access_token,
                c.refresh_token
            FROM
                accounts c
            WHERE
                c.phoneHash = :phone
        ";

        $result = $query->query($sql, ['phone' => $phone])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
        }

        return $result;
    }

    public static function findByAccessToken($accessToken)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                c.id as account_id,
                c.phone,
                c.password,
                c.role,
                c.status,
                c.created_at,
                c.access_token,
                c.refresh_token
            FROM
                accounts c
            WHERE
                access_token = :accessToken
        ";

        $result = $query->query($sql, ['accessToken' => $accessToken])->fetch();

        return $result;
    }

    public static function updateTokens($account_ID, $accessToken, $refreshToken)
    {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                accounts
            SET
                access_token = :accessToken,
                refresh_token = :refreshToken
            WHERE
                id = :account_ID
        ";

        $result = $query->query($sql, [
            'accessToken' => $accessToken,
            'refreshToken' => $refreshToken,
            'account_ID' => $account_ID
        ]);

        return $result;
    }

    // Thêm 1 account
    public static function addAccount($phone, $password, $role = 'user', $status = 'active')
    {
        $query = new ConnectDatabase();

        $created_at = Carbon::now();
        $password = Hash::encodeArgon2i($password);
        $phoneHash = Hash::encodeSha256($phone);
        $phone = Hash::encodeAes($phone);

        $sql =  "
            INSERT INTO
                accounts (phone, phoneHash, password, role, created_at, status)
            VALUES
                (:phone, :phoneHash, :password, :role, :created_at, :status)
        ";

        $result = $query->query($sql, [
            'phone' => $phone,
            'phoneHash' => $phoneHash,
            'password' => $password,
            'role' => $role,
            'created_at' => $created_at,
            'status' => $status
        ]);

        return $result;
    }
}
