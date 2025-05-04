<?php

namespace App\Models;

use App\Helpers\Carbon;

class GHNModel {
  // Thêm đơn hàng vận chuyển
  public static function insertOrder(
    $from_name,
    $from_phone,
    $from_address,
    $from_ward_name,
    $from_district_name,
    $from_province_name,
    $to_name,
    $to_phone,
    $to_address,
    $to_ward_name,
    $to_district_name,
    $to_province_name,
    $order_code,
    $from_estimate_date,
    $to_estimate_date
  ) {
    $conn = new ConnectDatabase();

    $created_at = Carbon::now();

    $sql = "
      INSERT INTO giaohangnhanh (
        from_name,
        from_phone,
        from_address,
        from_ward_name,
        from_district_name,
        from_province_name,
        to_name,
        to_phone,
        to_address,
        to_ward_name,
        to_district_name,
        to_province_name,
        order_code,
        from_estimate_date,
        to_estimate_date,
        created_at
      ) VALUES (
        :from_name,
        :from_phone,
        :from_address,
        :from_ward_name,
        :from_district_name,
        :from_province_name,
        :to_name,
        :to_phone,
        :to_address,
        :to_ward_name,
        :to_district_name,
        :to_province_name,
        :order_code,
        :from_estimate_date,
        :to_estimate_date,
        :created_at
      )
    ";

    $conn->query($sql, [
      ':from_name' => $from_name,
      ':from_phone' => $from_phone,
      ':from_address' => $from_address,
      ':from_ward_name' => $from_ward_name,
      ':from_district_name' => $from_district_name,
      ':from_province_name' => $from_province_name,
      ':to_name' => $to_name,
      ':to_phone' => $to_phone,
      ':to_address' => $to_address,
      ':to_ward_name' => $to_ward_name,
      ':to_district_name' => $to_district_name,
      ':to_province_name' => $to_province_name,
      ':order_code' => $order_code,
      ':from_estimate_date' => $from_estimate_date,
      ':to_estimate_date' => $to_estimate_date,
      ':created_at' => $created_at
    ]);

    return true;
  }

  // Thêm status đơn hàng vận chuyển
  public static function insertStatus($order_code, $status, $message) {
    $conn = new ConnectDatabase();

    $created_at = Carbon::now();

    $sql = "
      INSERT INTO giaohangnhanh_status (
        order_code,
        status,
        message,
        created_at
      ) VALUES (
        :order_code,
        :status,
        :message,
        :created_at
      )
    ";

    $conn->query($sql, [
      ':order_code' => $order_code,
      ':status' => $status,
      ':message' => $message,
      ':created_at' => $created_at
    ]);

    return true;
  }

  // Lấy 1 đơn hàng vận chuyển
  public static function find($order_code) {
    $conn = new ConnectDatabase();

    $sql = "
      SELECT * FROM giaohangnhanh WHERE order_code = :order_code
    ";

    return $conn->query($sql, [':order_code' => $order_code])->fetch();
  }

  // Lấy status cuối cùng
  public static function getLastStatus($order_code) {
    $conn = new ConnectDatabase();

    $sql = "
      SELECT * FROM giaohangnhanh_status WHERE order_code = :order_code ORDER BY created_at DESC LIMIT 1
    ";

    return $conn->query($sql, [':order_code' => $order_code])->fetch();
  }
}
