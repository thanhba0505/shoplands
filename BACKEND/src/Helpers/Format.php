<?php

namespace App\Helpers;

class Format {
  public static function number($number, $decimals = 2) {
    // Làm tròn số và định dạng theo yêu cầu
    $roundedNumber = round($number, $decimals);

    // Định dạng số với phân tách hàng nghìn và chữ số thập phân
    return $roundedNumber;
  }

  public static function getOrderStatusInVie($status) {
    $statusMapping = [
      "unpaid" => "Chưa thanh toán",
      "ready_to_pick" => "Đã thanh toán",
      "picking" => "Nhân viên đang lấy hàng",
      "deleted" => "Đã xóa khi không thanh toán",
      "cancel" => "Hủy đơn hàng",
      "money_collect_picking" => "Đang thu tiền người gửi",
      "picked" => "Nhân viên đã lấy hàng",
      "storing" => "Hàng đang nằm ở kho",
      "transporting" => "Đang luân chuyển hàng",
      "sorting" => "Đang phân loại hàng hóa",
      "delivering" => "Nhân viên đang giao cho người nhận",
      "money_collect_delivering" => "Nhân viên đang thu tiền người nhận",
      "delivered" => "Nhân viên đã giao hàng thành công",
      "delivery_fail" => "Nhân viên giao hàng thất bại",
      "waiting_to_return" => "Đang đợi trả hàng về cho người gửi",
      "return" => "Trả hàng",
      "return_transporting" => "Đang luân chuyển hàng trả",
      "return_sorting" => "Đang phân loại hàng trả",
      "returning" => "Nhân viên đang đi trả hàng",
      "return_fail" => "Nhân viên trả hàng thất bại",
      "returned" => "Nhân viên trả hàng thành công",
      "exception" => "Đơn hàng ngoại lệ không nằm trong quy trình",
      "damage" => "Hàng bị hư hỏng",
      "lost" => "Hàng bị mất",
      "completed" => "Đã hoàn thành"
    ];

    return isset($statusMapping[$status]) ? $statusMapping[$status] : "Không xác định";
  }
}
