<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class VerificationCodeModel
{
    // Thêm 1 dòng 
    public static function addVerificationCode($message_sid, $code, $created_date_time, $phone)
    {
        $query = new ConnectDatabase();

        $sql =  "
            INSERT INTO
                verification_codes (message_sid, code, created_date_time, phone)
            VALUES
                (:message_sid, :code, :created_date_time, :phone)
        ";

        $result = $query->query($sql, [
            'message_sid' => $message_sid,
            'code' => $code,
            'created_date_time' => $created_date_time,
            'phone' => $phone
        ]);

        return $result;
    }

    // Cập nhật code
    public static function updateVerificationCode($message_sid, $code, $created_date_time, $phone)
    {
        $query = new ConnectDatabase();

        $sql =  "
            UPDATE
                verification_codes
            SET
                message_sid = :message_sid,
                code = :code,
                created_date_time = :created_date_time
            WHERE
                phone = :phone
        ";

        $result = $query->query($sql, [
            'message_sid' => $message_sid,
            'code' => $code,
            'created_date_time' => $created_date_time,
            'phone' => $phone
        ]);

        return $result;
    }

    // Kiểm tra phone
    public static function checkPhone($phone)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                *
            FROM
                verification_codes
            WHERE
                phone = :phone
        ";

        $result = $query->query($sql, ['phone' => $phone])->fetch();

        return $result ?? false;
    }

    // Lấy theo phone
    public static function getByPhone($phone)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                vc.id,
                vc.message_sid,
                vc.code,
                vc.created_date_time,
                vc.phone
            FROM
                verification_codes vc
            WHERE
                vc.phone = :phone
        ";

        $result = $query->query($sql, ['phone' => $phone])->fetch();

        return $result ?? false;
    }
}
