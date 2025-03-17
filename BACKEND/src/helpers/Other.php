<?php

namespace App\Helpers;

class Other {
  public static function generateCode($length = 6) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  public static function generateFileName($title, $extension = 'png', $separator = '-') {
    $uniqueCode = time() . bin2hex(random_bytes(5));

    $fileName = $title . $separator . $uniqueCode . '.' . $extension;

    return $fileName;
  }
}
