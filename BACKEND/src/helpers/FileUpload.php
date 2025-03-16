<?php

namespace App\Helpers;

use Exception;

class FileUpload {
  

  /**
   * Lưu ảnh vào thư mục public
   *
   * @param array $file Mảng file từ form upload
   * @param string $directory Thư mục lưu ảnh (ví dụ: 'images', 'documents')
   * @return string|false Đường dẫn file nếu thành công, false nếu thất bại
   */
  public static function saveImage($file, $directory = 'images') {
    // Kiểm tra nếu file đã được upload
    if ($file['error'] != UPLOAD_ERR_OK) {
      return false;
    }

    // Tạo thư mục lưu ảnh nếu chưa có
    $uploadDir = 'public/' . $directory;
    if (!file_exists($uploadDir)) {
      mkdir($uploadDir, 0777, true); // Tạo thư mục với quyền ghi
    }

    // Lấy thông tin file
    $fileName = basename($file['name']);
    $filePath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;

    // Di chuyển file vào thư mục public
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
      return $filePath; // Trả về đường dẫn đến file
    } else {
      return false; // Nếu không thể di chuyển file
    }
  }
}
