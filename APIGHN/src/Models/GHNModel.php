<?php

namespace App\Models;

use App\Helpers\Carbon;

class GHNModel {
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
}
