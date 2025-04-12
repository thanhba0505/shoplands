<?php

namespace App\Helpers;

class GHN {
  // Hàm gửi yêu cầu GET cho GHN
  public static function ghnGet($url, $shop_id = false) {
    $headers = [
      'Content-Type: application/json',
      'token: ' . $_ENV['GHN_TOKEN'],
    ];

    if ($shop_id) {
      $headers[] = 'shop_id: ' . $_ENV['GHN_SHOP_ID'];
    }

    return CallApi::get($_ENV['GHN_URL'] . $url, $headers);
  }

  // Hàm gửi yêu cầu POST cho GHN
  public static function ghnPost($url, $data, $shop_id = false) {
    $headers = [
      'Content-Type: application/json',
      'token: ' . $_ENV['GHN_TOKEN'],
    ];

    if ($shop_id) {
      $headers[] = 'shop_id: ' . $_ENV['GHN_SHOP_ID'];
    }

    return CallApi::post($_ENV['GHN_URL'] . $url, $data, $headers);
  }

  public static function getProvinces() {
    return self::ghnGet('/master-data/province');
  }

  public static function getDistricts($province_id) {
    $url = '/master-data/district';

    if ($province_id) {
      $url .= '?province_id=' . $province_id;
    }

    return self::ghnGet($url);
  }

  public static function getWards($district_id) {
    return self::ghnGet('/master-data/ward?district_id=' . $district_id);
  }
}
