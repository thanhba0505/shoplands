<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class AccountModel
{
    public static function findById($id)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                *
            FROM
                accounts
            WHERE
                id = :id
        ";

        $result = $query->query($sql, ['id' => $id])->fetch();

        return $result;
    }

    public static function findByPhone($phone)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                *
            FROM
                accounts
            WHERE
                phone = :phone
        ";

        $result = $query->query($sql, ['phone' => $phone])->fetch();

        return $result;
    }

    public static function findByAccessToken($accessToken)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                *
            FROM
                accounts
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

    // Kiểm tra số điện thoại
    public static function checkPhone($phone)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                *
            FROM
                accounts
            WHERE
                phone = :phone
        ";

        $result = $query->query($sql, ['phone' => $phone])->fetch();

        return $result ?? false;
    }

    // Thêm 1 account
    public static function addAccount($phone, $password, $role = 'user', $status = 'active', $accessToken = null, $refreshToken = null)
    {
        $query = new ConnectDatabase();

        $time_start = date('Y-m-d H:i:s');

        $sql =  "
            INSERT INTO
                accounts (phone, password, role, time_start, status, access_token, refresh_token)
            VALUES
                (:phone, :password, :role, :time_start, :status, :accessToken, :refreshToken)
        ";

        $result = $query->query($sql, [
            'phone' => $phone,
            'password' => $password,
            'role' => $role,
            'time_start' => $time_start,
            'status' => $status,
            'accessToken' => $accessToken,
            'refreshToken' => $refreshToken
        ]);

        return $result;
    }
}
