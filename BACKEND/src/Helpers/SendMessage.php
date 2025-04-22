<?php

namespace App\Helpers;

use Exception;
use Twilio\Rest\Client;
use App\Helpers\Log;
use App\Models\MessageModel;
use App\Helpers\Carbon;

class SendMessage {
  private static $sid;
  private static $token;
  private static $twilioNumber;
  private static $timeExpired;

  // Khởi tạo static thông qua phương thức init()
  public static function init() {
    self::$sid = $_ENV['TWILIO_SID'];
    self::$token = $_ENV['TWILIO_TOKEN'];
    self::$twilioNumber = $_ENV['TWILIO_NUMBER'];
    self::$timeExpired = $_ENV['TWILIO_EXPIRY'];
  }

  // Phương thức chung gửi tin nhắn
  public static function send($phoneNumber, $messageBody) {
    try {
      $phoneNumberFormat = Validator::formatPhone($phoneNumber, '+84');

      // Nếu số điẹn thoại la +84374330542, gửi tin nhắn SMS
      if ($phoneNumberFormat === "+84374330542") {
        // Gửi tin nhắn SMS
        $client = new Client(self::$sid, self::$token);

        $message = $client->messages->create(
          $phoneNumberFormat,
          [
            'from' => self::$twilioNumber,
            'body' => $messageBody
          ]
        );

        if ($message->sid) {
          // Log thông tin tin nhắn
          Log::sms([
            'message' => $messageBody
          ], "Số điện thoại: " . $phoneNumber);

          return [
            'message_sid' => $message->sid
          ];
        } else {
          return false;
        }
        // Nếu số điện thoại khác, chỉ log thông tin
      } else {
        Log::sms([
          'message' => $messageBody
        ], "Số điện thoại: " . $phoneNumber);

        return [
          'message' => $messageBody
        ];
      }
    } catch (Exception $e) {
      // Nếu có lỗi, trả về false
      return false;
    }
  }

  // Phương thức gửi mã xác nhận 
  public static function sendMessageCode($phoneNumber, $account_id) {
    $code = Other::generateCode(6);
    $content = "Mã xác nhận của bạn là: " . $code;

    $result = self::send($phoneNumber, $content);

    if ($result) {
      MessageModel::addMessage($content, $code, $account_id);
      return $result;
    }

    return false;
  }

  // Kiểm tra thời gian hết hạn
  public static function checkMessageCodeExpired($time) {
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
