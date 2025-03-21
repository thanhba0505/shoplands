<?php

namespace App\Helpers;

use Exception;

class FileSave {
  // Đường dẫn cơ sở lưu trữ (thư mục)
  private static $basePath = 'src/storage/';

  // Lưu ảnh vào thư mục và trả về tên file
  public static function image($file, $subPath = '', $maxSize = 10485760) {
    // Kiểm tra nếu file tồn tại và không rỗng
    if (!$file || $file['error'] === UPLOAD_ERR_NO_FILE) {
      return [
        'success' => false,
        'message' => "Không có file nào được chọn."
      ];
    }

    // Kiểm tra nếu file tồn tại và là ảnh hợp lệ
    if ($file['error'] !== UPLOAD_ERR_OK) {
      return [
        'success' => false,
        'message' => "Lỗi khi tải file."
      ];
    }

    // Lấy các thông tin cần thiết
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileType = $file['type'];

    // Kiểm tra kích thước file (maxSize mặc định là 10MB)
    if ($fileSize > $maxSize) {
      return [
        'success' => false,
        'message' => "Kích thước file vượt quá giới hạn cho phép."
      ];
    }

    // Kiểm tra loại file (chỉ cho phép ảnh)
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($fileType, $allowedTypes)) {
      return [
        'success' => false,
        'message' => "File không phải là ảnh hợp lệ."
      ];
    }

    // Tạo tên file mới (thêm timestamp để tránh trùng lặp)
    $newFileName = time() . '_' . basename($fileName);

    // Kết hợp basePath với subPath (nếu có)
    $uploadDir = self::$basePath . $subPath;

    // Đảm bảo thư mục upload tồn tại
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true);  // Tạo thư mục nếu không có
    }

    // Đường dẫn đầy đủ đến file sẽ lưu
    $filePath = $uploadDir . '/' . $newFileName;

    // Di chuyển file từ thư mục tạm tới thư mục đích
    if (move_uploaded_file($fileTmpName, $filePath)) {
      return [
        'success' => true,
        'message' => $newFileName
      ];  // Trả về tên file đã lưu
    } else {
      return [
        'success' => false,
        'message' => "Không thể lưu file."
      ];
    }
  }


  // Thêm ảnh sản phẩm
  public static function productImage($file) {
    return self::image($file, 'public/product/', 5242880); // 5MB
  }
}
