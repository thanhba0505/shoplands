<?php

namespace App\Helpers;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

class QRCode {
  private static $basePath = 'src/storage/public/';

  private static function createQRCode($data, $outputPath, $size = 300, $logoPath = "", $logoSize = 50) {

    $fullPath = self::$basePath . $outputPath;

    $directory = dirname($fullPath);  // Lấy thư mục chứa tệp
    if (!file_exists($directory)) {
      mkdir($directory, 0777, true);  // Tạo thư mục với quyền ghi
    }

    // Tạo đối tượng Builder với các tùy chỉnh chỉ có size và logo
    $builder = new Builder(
      writer: new PngWriter(),
      writerOptions: [],
      validateResult: false,
      data: $data,
      encoding: new Encoding('UTF-8'),
      errorCorrectionLevel: ErrorCorrectionLevel::High,
      size: $size,  // Kích thước của mã QR
      margin: 10,  // Lề mặc định
      roundBlockSizeMode: RoundBlockSizeMode::Margin,  // Mẫu bo tròn mặc định
      logoPath: $logoPath,  // Đường dẫn logo
      logoResizeToWidth: $logoSize,  // Kích thước logo
      logoPunchoutBackground: true  // Loại bỏ nền của logo
    );

    // Tạo mã QR và lưu vào thư mục public
    $result = $builder->build();
    $result->saveToFile($fullPath);

    return $fullPath;
  }

  public static function createPayment($paymentLink, $fileName) {
    $outputPath = 'qrcode/' . $fileName . '.png';
    return self::createQRCode($paymentLink, $outputPath);
  }
}
