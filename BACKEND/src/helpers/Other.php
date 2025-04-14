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

  // Nhóm status
  public static function groupStatus($status) {
    if (empty($status)) {
      return [];
    }

    $groupedStatus = [
      "unpaid" => ["unpaid"],
      "waiting" => [
        "ready_to_pick",
        "picking",
        "money_collect_picking",
        "picked",
        "storing",
        "transporting",
        "sorting"
      ],
      "shipping" => [
        "delivering",
        "money_collect_delivering",
        "delivery_fail",
      ],
      "completed" => [
        "delivered",
      ],
      "return" => [
        "waiting_to_return",
        "return",
        "return_transporting",
        "return_sorting",
        "returning",
        "return_fail",
        "returned",
      ],
      "other" => [
        "cancel",
        "exception",
        "damage",
        "lost",
      ]
    ];
    return isset($groupedStatus[$status]) ? $groupedStatus[$status] : [];
  }
}
