<?php

namespace App\Helpers;

class Format {
  public static function number($number, $decimals = 2) {
    // Làm tròn số và định dạng theo yêu cầu
    $roundedNumber = round($number, $decimals);

    // Định dạng số với phân tách hàng nghìn và chữ số thập phân
    return $roundedNumber;
  }
}
