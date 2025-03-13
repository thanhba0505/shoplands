<?php

namespace App\Helpers;

use Exception;
use Twilio\Rest\Client;
use App\Helpers\Log;
use App\Models\MessageModel;
use App\Helpers\Carbon;

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
      $phoneNumber = Validator::formatPhone($phoneNumber, '+84');
      // Giả sử gửi tin nhắn
      Log::sms([
        'body' => $messageBody
      ], "Số điện thoại: " .  $phoneNumber);

      return true;
    } catch (Exception $e) {
      // Nếu có lỗi, trả về false
      Log::sms([
        'error' => $e
      ], "Số điện thoại: " .  $phoneNumber);
      return false;
    }
    // try {
    //   // Gửi tin nhắn SMS
    //   $client = new Client(self::$sid, self::$token);

    //   $message = $client->messages->create(
    //     $phoneNumber,
    //     [
    //       'from' => self::$twilioNumber,
    //       'body' => $messageBody
    //     ]
    //   );

    //   if ($message->sid) {
    //     // Log thông tin tin nhắn
    //     Log::sms([
    //       'message_sid' => $message->sid,
    //       'body' => $messageBody
    //     ], $phoneNumber);

    //     return [
    //       'message_sid' => $message->sid
    //     ];
    //   } else {
    //     return false;
    //   }
    // } catch (Exception $e) {
    //   // Nếu có lỗi, trả về false
    //   return false;
    // }
  }

  // Phương thức gửi mã xác nhận 
  public static function sendMessageCode($phoneNumber, $account_id)
  {
    $code = Other::generateCode(6);
    $content = "Mã xác nhận của bạn là: " . $code;

    $result = self::send($phoneNumber, $content);

    if ($result) {
      MessageModel::addMessage($content, $code, $account_id);
      return true;
    }

    return false;
  }

  // Kiểm tra thời gian hết hạn
  public static function checkMessageCodeExpired($time)
  {
    $time = strtotime($time);
    if (!$time) {
      return false; 
    }

    $timeExpired = (int) self::$timeExpired; 

    $currentTime = strtotime(Carbon::now());  

    $timeDiff = $currentTime - $time;

    return $timeDiff <= $timeExpired;
  }
}

SendMessage::init();