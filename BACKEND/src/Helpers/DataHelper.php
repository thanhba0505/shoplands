<?php

namespace App\Helpers;

class DataHelper {
  /**
   * Nhóm dữ liệu theo cấu hình
   *
   * @param array $data Mảng dữ liệu đầu vào
   * @param array $config Cấu hình nhóm dữ liệu
   * @return array Mảng dữ liệu đã được nhóm
   */
  public static function groupData(array $data, array $config): array {
    $result = [];
    $grouped = [];

    // Nhóm các sản phẩm cùng product_id lại với nhau
    foreach ($data as $item) {
      $key = self::generateItemKey($item, $config['keep_columns']);
      if (!isset($grouped[$key])) {
        $grouped[$key] = [
          'base_data' => self::extractBaseData($item, $config['keep_columns']),
          'grouped_data' => self::initializeGroupedData($config['group_columns'])
        ];
      }

      // Thêm dữ liệu vào các nhóm
      foreach ($config['group_columns'] as $groupKey => $columns) {
        $groupItem = [];
        foreach ($columns as $column) {
          if (isset($item[$column])) {
            $groupItem[$column] = $item[$column];
          }
        }
        $grouped[$key]['grouped_data'][$groupKey][] = $groupItem;
      }
    }

    // Gộp base data và grouped data vào kết quả
    foreach ($grouped as $item) {
      $result[] = array_merge($item['base_data'], $item['grouped_data']);
    }

    return array_values($result);
  }

  /**
   * Tạo key duy nhất cho item dựa trên các cột keep_columns
   *
   * @param array $item
   * @param array $keepColumns
   * @return string
   */
  private static function generateItemKey(array $item, array $keepColumns): string {
    $keyParts = [];
    foreach ($keepColumns as $column) {
      if (isset($item[$column])) {
        $keyParts[] = $column . ':' . $item[$column];
      }
    }
    return implode('|', $keyParts);
  }

  /**
   * Trích xuất dữ liệu cơ bản từ item
   *
   * @param array $item
   * @param array $keepColumns
   * @return array
   */
  private static function extractBaseData(array $item, array $keepColumns): array {
    $baseData = [];
    foreach ($keepColumns as $column) {
      if (isset($item[$column])) {
        $baseData[$column] = $item[$column];
      }
    }
    return $baseData;
  }

  /**
   * Khởi tạo cấu trúc dữ liệu nhóm
   *
   * @param array $groupColumns
   * @return array
   */
  private static function initializeGroupedData(array $groupColumns): array {
    $groupedData = [];
    foreach (array_keys($groupColumns) as $groupKey) {
      $groupedData[$groupKey] = [];
    }
    return $groupedData;
  }
}
