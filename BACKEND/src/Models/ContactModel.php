<?php

namespace App\Models;

use App\Helpers\Carbon;
use App\Helpers\Hash;
use App\Models\ConnectDatabase;

class ContactModel {
    public static function create($name, $phone, $topic, $content) {
        $conn = new ConnectDatabase();

        $phoneHash = Hash::encodeSha256($phone);
        $phone = Hash::encodeAes($phone);

        $sql = "
            INSERT INTO contact (
                name,
                phone,
                phoneHash,
                content,
                topic,
                created_at
            ) VALUES (
                :name,
                :phone,
                :phoneHash,
                :content,
                :topic,
                :created_at
            )
        ";

        $conn->query($sql, [
            'name' => $name,
            'phone' => $phone,
            'phoneHash' => $phoneHash,
            'content' => $content,
            'topic' => $topic,
            'created_at' => Carbon::now(),
        ]);

        return $conn->getConnection()->lastInsertId();
    }
}
