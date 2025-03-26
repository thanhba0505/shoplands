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
                a.id as account_id,
                a.phone,
                a.password,
                a.bank_number,
                a.bank_name,
                a.coin,
                a.role,
                a.status,
                a.created_at,
                a.device_token,
                a.access_token,
                a.refresh_token
            FROM
                accounts a
            WHERE
                a.id = :id
        ";

        $result = $query->query($sql, ['id' => $id])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
            $result['bank_number'] = Hash::decodeAes($result['bank_number']);
            $result['bank_name'] = Hash::decodeAes($result['bank_name']);
        }

        return $result;
    }

    public static function findByPhone($phone)
    {
        $phone = Hash::encodeSha256($phone);

        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                a.id as account_id,
                a.phone,
                a.password,
                a.role,
                a.bank_number,
                a.bank_name,
                a.status,
                a.coin,
                a.created_at,
                a.device_token,
                a.access_token,
                a.refresh_token
            FROM
                accounts a
            WHERE
                a.phoneHash = :phone
        ";

        $result = $query->query($sql, ['phone' => $phone])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
            $result['bank_number'] = Hash::decodeAes($result['bank_number']);
            $result['bank_name'] = Hash::decodeAes($result['bank_name']);
        }

        return $result;
    }

    public static function findByAccessToken($accessToken)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                a.id as account_id,
                a.phone,
                a.password,
                a.role,
                a.bank_number,
                a.bank_name,
                a.coin,
                a.status,
                a.created_at,
                a.device_token,
                a.access_token,
                a.refresh_token
            FROM
                accounts a
            WHERE
                a.access_token = :accessToken
        ";

        $result = $query->query($sql, ['accessToken' => $accessToken])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
            $result['bank_number'] = Hash::decodeAes($result['bank_number']);
            $result['bank_name'] = Hash::decodeAes($result['bank_name']);
        }

        return $result;
    }

    public static function updateTokens($account_id, $accessToken, $refreshToken)
    {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                accounts
            SET
                access_token = :accessToken,
                refresh_token = :refreshToken
            WHERE
                id = :account_id
        ";

        $result = $query->query($sql, [
            'accessToken' => $accessToken,
            'refreshToken' => $refreshToken,
            'account_id' => $account_id
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

    // Sửa account
    public static function activeAccount($account_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                accounts
            SET
                status = 'active'
            WHERE
                id = :account_id
        ";

        $result = $query->query($sql, ['account_id' => $account_id]);

        return $result;
    }

    // Cập nhật device_token
    public static function updateDeviceToken($account_id, $ip_address, $user_agent)
    {
        $query = new ConnectDatabase();

        $device_token = Hash::encodeArgon2i($ip_address . $user_agent);

        $sql = "
            UPDATE
                accounts
            SET
                device_token = :device_token
            WHERE
                id = :account_id
        ";

        $result = $query->query($sql, ['device_token' => $device_token, 'account_id' => $account_id]);

        return $result;
    }

    // Xóa device_token
    public static function deleteDeviceToken($account_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                accounts
            SET
                device_token = NULL
            WHERE
                id = :account_id
        ";

        $result = $query->query($sql, ['account_id' => $account_id]);

        return $result;
    }

    // Cập nhật password
    public static function updatePassword($account_id, $password)
    {
        $query = new ConnectDatabase();

        $password = Hash::encodeArgon2i($password);

        $sql = "
            UPDATE
                accounts
            SET
                password = :password
            WHERE
                id = :account_id
        ";

        $result = $query->query($sql, ['password' => $password, 'account_id' => $account_id]);

        return $result;
    }
}
