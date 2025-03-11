<?php

namespace App\Helpers;

use Exception;
use Twilio\Rest\Client;
use App\Helpers\Log;

class VerificationCode
{
  public static function generateCode($length = 6)
  {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  // Gửi má xác nhận tài khoản
  public static function sendCode($phoneNumber)
  {
    $sid    = $_ENV['TWILIO_SID'];
    $token  = $_ENV['TWILIO_TOKEN'];
    $twilioNumber = $_ENV['TWILIO_NUMBER'];

    try {
      $client = new Client($sid, $token);
      $verificationCode = self::generateCode();

      // Gửi tin nhắn SMS
      $message = $client->messages->create(
        $phoneNumber,
        [
          'from' => $twilioNumber,
          'body' => "Mã xác nhận của bạn là: $verificationCode"
        ]
      );

      Log::sms([
        'code' => $verificationCode,
        'message_sid' => $message->sid,
      ], $phoneNumber);

      return [
        'code' => $verificationCode,
        'message_sid' => $message->sid
      ];
    } catch (Exception $e) {
      return false;
    }
  }

  // Kiểm tra thời gian xác nhận
  public static function checkTime($time)
  {

    $timeExpired = (int) $_ENV['TWILIO_EXPIRY'];

    $currentTime = time();
    $timeDiff = $currentTime - $time;

    return $timeDiff <= $timeExpired;
  }
}
