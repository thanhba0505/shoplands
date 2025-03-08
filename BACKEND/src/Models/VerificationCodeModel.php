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
}
