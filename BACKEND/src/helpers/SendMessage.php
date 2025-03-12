<?php

namespace App\Helpers;

use Exception;
use Twilio\Rest\Client;
use App\Helpers\Log;

class SendMessage
{
  private static $sid;
  private static $token;
  private static $twilioNumber;
  private static $timeExpired;

  // Khởi tạo static thông qua phương thức init()
  public static function init()
  {
    self::$sid = $_ENV['TWILIO_SID'];
    self::$token = $_ENV['TWILIO_TOKEN'];
    self::$twilioNumber = $_ENV['TWILIO_NUMBER'];
    self::$timeExpired = $_ENV['TWILIO_EXPIRY'];
  }

  // Phương thức chung gửi tin nhắn
  public static function send($phoneNumber, $messageBody)
  {
    try {
      // Gửi tin nhắn SMS
      $client = new Client(self::$sid, self::$token);
      
      $message = $client->messages->create(
        $phoneNumber,
        [
          'from' => self::$twilioNumber,
          'body' => $messageBody
        ]
      );
      
      if ($message->sid) {
        // Log thông tin tin nhắn
        Log::sms([
          'message_sid' => $message->sid,
          'body' => $messageBody
        ], $phoneNumber);

        return [
          'message_sid' => $message->sid
        ];
      } else {
        return false;
      }
    } catch (Exception $e) {
      // Nếu có lỗi, trả về false
      return false;
    }
  }

  // Phương thức gửi mã xác nhận
  public static function sendLoginCode($phoneNumber)
  {
    $result['code'] = Other::generateCode(6);
    $result['message_sid'] = self::send($phoneNumber, $result['code']);

    return $result['message_sid'] ? $result : false;
  }

  // Kiểm tra thời gian hết hạn
  public static function checkTimeExpired($time)
  {

    $time = strtotime($time);
    if (!$time) {
      return false;
    }

    $timeExpired = self::$timeExpired;
    if (!is_numeric($timeExpired) || $timeExpired <= 0) {
      return false;
    }

    $currentTime = time();
    $timeDiff = $currentTime - $time;

    return $timeDiff <= (int) $timeExpired;
  }
}
