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

      // Thêm dữ liệu vào các nhóm và loại bỏ trùng lặp
      foreach ($config['group_columns'] as $groupKey => $columns) {
        $groupItem = [];
        foreach ($columns as $column) {
          // Luôn thêm tất cả columns, nếu không có dữ liệu thì để null
          $groupItem[$column] = $item[$column] ?? null;
        }

        // Kiểm tra trùng lặp trước khi thêm vào nhóm
        if (!self::isDuplicate($grouped[$key]['grouped_data'][$groupKey], $groupItem, $columns)) {
          $grouped[$key]['grouped_data'][$groupKey][] = $groupItem;
        }
      }
    }

    // Gộp base data và grouped data vào kết quả
    foreach ($grouped as $item) {
      // Loại bỏ trùng lặp trong từng nhóm một lần nữa (để đảm bảo)
      $cleanedGroupedData = [];
      foreach ($item['grouped_data'] as $groupKey => $groupItems) {
        $cleanedGroupedData[$groupKey] = self::removeDuplicates($groupItems, $config['group_columns'][$groupKey]);
      }

      $result[] = array_merge($item['base_data'], $cleanedGroupedData);
    }

    return array_values($result);
  }

  /**
   * Kiểm tra xem item có trùng lặp trong nhóm hay không
   *
   * @param array $groupItems
   * @param array $newItem
   * @param array $columns
   * @return bool
   */
  private static function isDuplicate(array $groupItems, array $newItem, array $columns): bool {
    foreach ($groupItems as $item) {
      $isSame = true;
      foreach ($columns as $column) {
        if (($item[$column] ?? null) !== ($newItem[$column] ?? null)) {
          $isSame = false;
          break;
        }
      }
      if ($isSame) {
        return true;
      }
    }
    return false;
  }

  /**
   * Loại bỏ các bản ghi trùng lặp trong nhóm
   *
   * @param array $groupItems
   * @param array $columns
   * @return array
   */
  private static function removeDuplicates(array $groupItems, array $columns): array {
    $uniqueItems = [];
    $seen = [];

    foreach ($groupItems as $item) {
      $keyParts = [];
      foreach ($columns as $column) {
        $keyParts[] = $item[$column] ?? '';
      }
      $key = implode('|', $keyParts);

      if (!isset($seen[$key])) {
        $seen[$key] = true;
        $uniqueItems[] = $item;
      }
    }

    return $uniqueItems;
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
      $keyParts[] = $column . ':' . ($item[$column] ?? 'NULL');
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
      // Luôn thêm tất cả columns, nếu không có dữ liệu thì để null
      $baseData[$column] = $item[$column] ?? null;
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
