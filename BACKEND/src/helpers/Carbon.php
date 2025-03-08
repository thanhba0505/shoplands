<?php

namespace App\Helpers;

class Carbon
{
  // Lấy thời gian hiện tại
  public static function now($format = 'Y-m-d H:i:s')
  {
    return date($format);
  }

  // Lấy ngày hôm nay
  public static function today($format = 'Y-m-d')
  {
    return date($format);
  }

  // Lấy ngày giờ của ngày mai
  public static function tomorrow($format = 'Y-m-d')
  {
    return date($format, strtotime('+1 day'));
  }

  // Lấy ngày giờ của hôm qua
  public static function yesterday($format = 'Y-m-d')
  {
    return date($format, strtotime('-1 day'));
  }

  // Cộng thêm số ngày
  public static function addDays($days, $date = null, $format = 'Y-m-d H:i:s')
  {
    $date = $date ? strtotime($date) : time();
    return date($format, strtotime("+$days days", $date));
  }

  // Trừ đi số ngày
  public static function subDays($days, $date = null, $format = 'Y-m-d H:i:s')
  {
    $date = $date ? strtotime($date) : time();
    return date($format, strtotime("-$days days", $date));
  }

  // Cộng thêm số giờ
  public static function addHours($hours, $date = null, $format = 'Y-m-d H:i:s')
  {
    $date = $date ? strtotime($date) : time();
    return date($format, strtotime("+$hours hours", $date));
  }

  // Trừ đi số giờ
  public static function subHours($hours, $date = null, $format = 'Y-m-d H:i:s')
  {
    $date = $date ? strtotime($date) : time();
    return date($format, strtotime("-$hours hours", $date));
  }

  // Chuyển đổi chuỗi ngày thành timestamp
  public static function toTimestamp($date)
  {
    return strtotime($date);
  }

  // Chuyển timestamp thành chuỗi ngày
  public static function fromTimestamp($timestamp, $format = 'Y-m-d H:i:s')
  {
    return date($format, $timestamp);
  }

  // Kiểm tra xem một ngày có phải hôm nay không
  public static function isToday($date)
  {
    return date('Y-m-d', strtotime($date)) === date('Y-m-d');
  }

  // Kiểm tra xem một ngày có phải ngày mai không
  public static function isTomorrow($date)
  {
    return date('Y-m-d', strtotime($date)) === date('Y-m-d', strtotime('+1 day'));
  }

  // Kiểm tra xem một ngày có phải hôm qua không
  public static function isYesterday($date)
  {
    return date('Y-m-d', strtotime($date)) === date('Y-m-d', strtotime('-1 day'));
  }

  // Định dạng lại ngày
  public static function formatDate($date, $format = 'Y-m-d H:i:s')
  {
    return date($format, strtotime($date));
  }

  // Tính khoảng cách giữa 2 ngày (trả về số ngày)
  public static function diffInDays($date1, $date2)
  {
    return abs(floor((strtotime($date2) - strtotime($date1)) / (60 * 60 * 24)));
  }

  // Tính khoảng cách giữa 2 ngày (trả về số giờ)
  public static function diffInHours($date1, $date2)
  {
    return abs(floor((strtotime($date2) - strtotime($date1)) / (60 * 60)));
  }

  // Tính khoảng cách giữa 2 ngày (trả về số phút)
  public static function diffInMinutes($date1, $date2)
  {
    return abs(floor((strtotime($date2) - strtotime($date1)) / 60));
  }
}
