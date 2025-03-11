<?php

namespace App\Models;

use App\Helpers\Carbon;
use App\Helpers\Hash;
use App\Helpers\Log;
use App\Models\ConnectDatabase;

class VerificationCodeModel
{
    // Thêm 1 dòng 
    public static function addVerificationCode($message_sid, $code, $phone)
    {
        $query = new ConnectDatabase();

        $created_at = Carbon::now();
        $code = Hash::encodeArgon2i($code);
        $phoneHash = Hash::encodeSha256($phone);
        $phone = Hash::encodeAes($phone);

        Log::text($code);
        Log::text($phone);

        $sql =  "
            INSERT INTO
                verification_codes (message_sid, code, created_at, phone, phoneHash)
            VALUES
                (:message_sid, :code, :created_at, :phone, :phoneHash)
        ";

        $result = $query->query($sql, [
            'message_sid' => $message_sid,
            'code' => $code,
            'created_at' => $created_at,
            'phone' => $phone,
            'phoneHash' => $phoneHash
        ]);

        return $result;
    }

    // Cập nhật code
    public static function updateVerificationCode($message_sid, $code, $phone)
    {
        $query = new ConnectDatabase();

        $created_at = Carbon::now();
        $code = Hash::encodeArgon2i($code);
        $phone = Hash::encodeSha256($phone);

        $sql =  "
            UPDATE
                verification_codes
            SET
                message_sid = :message_sid,
                code = :code,
                created_at = :created_at
            WHERE
                phoneHash = :phone
        ";

        $result = $query->query($sql, [
            'message_sid' => $message_sid,
            'code' => $code,
            'created_at' => $created_at,
            'phone' => $phone
        ]);

        return $result;
    }

    // Tim kiếm theo phone
    public static function findByPhone($phone)
    {
        $phone = Hash::encodeSha256($phone);

        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                vc.id,
                vc.message_sid,
                vc.code,
                vc.created_at,
                vc.phone
            FROM
                verification_codes vc
            WHERE
                vc.phoneHash = :phone
        ";

        $result = $query->query($sql, ['phone' => $phone])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
        }

        return $result;
    }
}
