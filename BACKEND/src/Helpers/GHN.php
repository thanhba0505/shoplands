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

    $result = CallApi::get($_ENV['GHN_URL'] . $url, $headers);

    // Log::ghn($result, 'GET - ' . $_ENV['GHN_URL'] . $url);

    return $result;
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
    // Response::json($headers);

    $result = CallApi::postForm($_ENV['GHN_URL'] . $url, $data);

    // Log::ghn($result, 'POST - ' . $_ENV['GHN_URL'] . $url);

    return $result;
  }

  // Lấy danh sách tỉnh thành
  public static function getProvinces() {
    return self::ghnGet('/master-data/province');
  }

  // Lấy danh sách quận huyện
  public static function getDistricts($province_id) {
    $url = '/master-data/district';

    if ($province_id) {
      $url .= '?province_id=' . $province_id;
    }

    return self::ghnGet($url);
  }

  // Lấy danh sách phường xã
  public static function getWards($district_id) {
    return self::ghnGet('/master-data/ward?district_id=' . $district_id);
  }

  // Tạo đơn hàng
  public static function createOrder($from, $to) {
    // Tạo mảng dữ liệu cần gửi
    $data = [
      "payment_type_id" => 1,
      "required_note" => "KHONGCHOXEMHANG",

      // Thông tin trả hàng (return -> to)
      "return_phone" => $from['phone'],
      "return_address" => $from['address_line'],
      "return_district_id" => $from['district_id'],
      "return_ward_code" => $from['ward_id'],

      // Thông tin người gửi (from)
      "from_name" => $from['name'],
      "from_phone" => $from['phone'],
      "from_address" => $from['address_line'],
      "from_ward_name" => $from['ward_name'],
      "from_district_name" => $from['district_name'],
      "from_province_name" => $from['province_name'],

      // Thông tin người nhận (to)
      "to_name" => $to['name'],
      "to_phone" => $to['phone'],
      "to_address" => $to['address_line'],
      "to_ward_name" => $to['ward_name'],
      "to_district_name" => $to['district_name'],
      "to_province_name" => $to['province_name'],

      // Thông tin COD
      "cod_amount" => 0,

      // Thông tin đơn hàng
      "content" => "Đơn hàng vận chuyển của T&B",
      "length" => 12,
      "width" => 12,
      "height" => 12,
      "weight" => 1200,

      // Loại dịch vụ
      "service_type_id" => 2
    ];

    // Gửi dữ liệu lên API GHN
    return self::ghnPost('/v2/shipping-order/create', $data);
  }

  // Giả sử tạo đơn hàng
  public static function previewOrder($from, $to) {
    // Tạo mảng dữ liệu cần gửi
    $data = [
      "payment_type_id" => 1,
      "required_note" => "KHONGCHOXEMHANG",

      // Thông tin trả hàng (return -> to)
      "return_phone" => $from['phone'],
      "return_address" => $from['address_line'],
      "return_district_id" => $from['district_id'],
      "return_ward_code" => $from['ward_id'],

      // Thông tin người gửi (from)
      "from_name" => $from['name'],
      "from_phone" => $from['phone'],
      "from_address" => $from['address_line'],
      "from_ward_name" => $from['ward_name'],
      "from_district_name" => $from['district_name'],
      "from_province_name" => $from['province_name'],

      // Thông tin người nhận (to)
      "to_name" => $to['name'],
      "to_phone" => $to['phone'],
      "to_address" => $to['address_line'],
      "to_ward_name" => $to['ward_name'],
      "to_district_name" => $to['district_name'],
      "to_province_name" => $to['province_name'],

      // Thông tin COD
      "cod_amount" => 0,

      // Thông tin đơn hàng
      "content" => "Đơn hàng vận chuyển của T&B",
      "length" => 12,
      "width" => 12,
      "height" => 12,
      "weight" => 1200,

      // Loại dịch vụ
      "service_type_id" => 2
    ];

    // Gửi dữ liệu lên API GHN
    return self::ghnPost('/v2/shipping-order/preview', $data);
  }

  // Tính phí dịch vụ
  public static function calculateFee($from, $to) {
    $data = [
      "from_district_id" => intval($from['district_id']),
      "from_ward_code" => $from['ward_id'],

      "to_district_id" => intval($to['district_id']),
      "to_ward_code" => $to['ward_id'],

      "length" => 12,
      "width" => 12,
      "height" => 12,
      "weight" => 1200,

      "service_type_id" => 2
    ];

    return self::ghnPost('/v2/shipping-order/fee', $data);
  }

  // Tính thời gian dự kiến
  public static function calculateLeadtime($from, $to) {
    $data = [
      "from_district_id" => intval($from['district_id']),
      "from_ward_code" => $from['ward_id'],

      "to_district_id" => intval($to['district_id']),
      "to_ward_code" => $to['ward_id'],

      "service_id" => 53320
    ];

    return self::ghnPost('/v2/shipping-order/leadtime', $data);
  }

  // Lấy chi tiết đơn hàng theo order code
  public static function getOrder($order_code) {
    return self::ghnPost('/v2/shipping-order/detail', ['order_code' => strval($order_code)]);
  }

  // Lấy link trạng thái đơn hàng theo order code
  public static function getTrackingUrl($order_code) {
    return $order_code ? "https://tracking.ghn.dev/?order_code=" . $order_code : "";
  }
}
