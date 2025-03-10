<?php

namespace App\Models;

use App\Helpers\Carbon;
use App\Helpers\Hash;
use App\Models\ConnectDatabase;

class DeviceLoginModel
{
    // Lấy thông tin thiết bị theo account_id
    public static function getByAccountId($account_id)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                dl.id AS device_login_id,
                dl.device_token,
                dl.code,
                dl.created_at,
                dl.account_id
            FROM
                device_login dl
            WHERE
                dl.account_id = :account_id
        ";

        $result = $query->query($sql, ["account_id" => $account_id])->fetch();

        return $result ? $result : false;
    }

    // Thêm 1 thiet bị
    public static function insertOrUpdateDeviceLogin($account_id, $device_token, $message_sid,  $code)
    {
        $query = new ConnectDatabase();

        $created_at = Carbon::now();
        $code = Hash::encodeArgon2i($code);

        $sql = "
            INSERT INTO device_login (device_token, code, message_sid, account_id, created_at)
            VALUES (:device_token, :code, :message_sid, :account_id, :created_at)
            ON DUPLICATE KEY UPDATE
                device_token = VALUES(device_token),
                code = VALUES(code),
                created_at = VALUES(created_at);
        ";

        $result = $query->query($sql, [
            "device_token" => $device_token,
            "message_sid" => $message_sid,
            "code" => $code,
            "account_id" => $account_id,
            "created_at" => $created_at
        ]);

        return $result;
    }

    // Cập nhật token 
    public static function updateTokens($account_id, $device_token)
    {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE device_login
            SET 
                device_token = :device_token,
                code = NULL
            WHERE
                account_id = :account_id
        ";

        $result = $query->query($sql, [
            "device_token" => $device_token,
            "account_id" => $account_id
        ]);

        return $result;
    }
}
