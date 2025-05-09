<?php

namespace App\Models;

use App\Helpers\Carbon;
use App\Helpers\Hash;
use App\Helpers\Log;
use App\Models\ConnectDatabase;

class MessageModel {
  public static function addMessage($content, $code, $account_id) {
    $conn = new ConnectDatabase();

    $created_at = Carbon::now();
    $content = Hash::encodeArgon2i($content);
    $code = Hash::encodeArgon2i($code);

    $sql = "
          INSERT INTO 
              messages (content, code, account_id, created_at) 
          VALUES 
              (:content, :code, :account_id, :created_at)
      ";

    $result = $conn->query($sql, [
      ':content' => $content,
      ':code' => $code,
      ':account_id' => $account_id,
      ':created_at' => $created_at
    ]);

    return $result;
  }

  // Tìm kiếm tin nhắn mới nhất theo account_id
  public static function getLastMessage($account_id) {
    $conn = new ConnectDatabase();

    $sql = "
          SELECT 
              id AS message_id, 
              content, 
              code, 
              created_at, 
              deleted_at
          FROM 
              messages 
          WHERE 
              account_id = :account_id 
          ORDER BY 
              created_at DESC 
          LIMIT 1
      ";

    $result = $conn->query($sql, [
      ':account_id' => $account_id
    ])->fetch();

    return $result && $result['deleted_at'] == null ? $result : false;
  }

  // Xóa tin nhắn theo message_id
  public static function deleteMessage($message_id) {
    $conn = new ConnectDatabase();

    $sql = "
        UPDATE 
            messages 
        SET 
            deleted_at = :deleted_at 
        WHERE 
            id = :message_id
    ";

    $result = $conn->query($sql, [
      ':deleted_at' => Carbon::now(),
      ':message_id' => $message_id
    ]);

    return $result;
  }

  // Xóa tất cả tin trheo account_id
  public static function deleteAllMessage($account_id) {
    $conn = new ConnectDatabase();

    $sql = "
        DELETE FROM 
            messages 
        WHERE 
            account_id = :account_id
    ";

    $result = $conn->query($sql, [
      ':account_id' => $account_id
    ]);

    return $result;
  }
}
