<?php

namespace App\Helpers;

class CallApi {

  // Hàm gửi yêu cầu GET
  public static function get($url, $headers = []) {
    // Thay đổi khoảng cách và mã hóa ký tự đặc biệt trong query string
    $url = preg_replace_callback('/([?&])([^=]+)=([^&]*)/', function ($matches) {
      return $matches[1] . $matches[2] . '=' . urlencode($matches[3]);
    }, $url);

    // Khởi tạo cURL
    $ch = curl_init();

    // Cấu hình cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Cấu hình header nếu có
    if (!empty($headers)) {
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    // Thực thi và lấy kết quả
    $response = curl_exec($ch);

    // Kiểm tra lỗi cURL
    if (curl_errno($ch)) {
      $response = json_encode(['error' => curl_error($ch)]);
    }

    // Đóng cURL
    curl_close($ch);

    // Trả về dữ liệu nhận được từ API
    return json_decode($response, true);
  }

  // Hàm gửi yêu cầu POST
  public static function post($url, $data, $headers = []) {
    // Thay đổi khoảng cách và mã hóa ký tự đặc biệt trong query string
    $url = preg_replace_callback('/([?&])([^=]+)=([^&]*)/', function ($matches) {
      return $matches[1] . $matches[2] . '=' . urlencode($matches[3]);
    }, $url);

    // Khởi tạo cURL
    $ch = curl_init();

    // Cấu hình cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);

    // Cấu hình body của POST request
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Cấu hình header nếu có
    if (!empty($headers)) {
      curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge(
        ['Content-Type: application/json'],
        $headers
      ));
    }

    // Thực thi và lấy kết quả
    $response = curl_exec($ch);

    // Kiểm tra lỗi cURL
    if (curl_errno($ch)) {
      $response = json_encode(['error' => curl_error($ch)]);
    }

    // Đóng cURL
    curl_close($ch);

    // Trả về dữ liệu nhận được từ API
    return json_decode($response, true);
  }
}
