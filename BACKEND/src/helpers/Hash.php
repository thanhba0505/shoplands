<?php

namespace App\Helpers;

class Hash
{
  // ========================= LẤY KHÓA BÍ MẬT =========================

  // Lấy khóa bí mật cho Argon2i từ .env
  private static function getArgonKey()
  {
    return $_ENV['ARGON_SECRET_KEY'] ?? 'default-argon-key';
  }

  // Lấy khóa bí mật cho AES-256 từ .env
  private static function getAesKey()
  {
    if (!isset($_ENV['AES_SECRET_KEY'])) {
      throw new \Exception("AES_SECRET_KEY is not set in .env");
    }

    // Lấy chuỗi key từ .env và chuyển thành key 32 bytes bằng SHA-256
    $rawKey = $_ENV['AES_SECRET_KEY'];
    $key = hash('sha256', $rawKey, true); // true để trả về dạng nhị phân

    return $key;
  }

  // Tạo IV ngẫu nhiên cho AES-256
  private static function generateIv()
  {
    return random_bytes(openssl_cipher_iv_length("AES-256-CBC"));
  }

  // ========================= PASSWORD_ARGON2I (MÃ HÓA MỘT CHIỀU) =========================

  // Mã hóa mật khẩu bằng PASSWORD_ARGON2I
  public static function encodeArgon2i($password)
  {
    $key = self::getArgonKey();
    $passwordWithKey = hash_hmac('sha256', $password, $key);
    return password_hash($passwordWithKey, PASSWORD_ARGON2I);
  }

  // Kiểm tra mật khẩu với hash đã lưu
  public static function verifyArgon2i($password, $hashedPassword)
  {
    $key = self::getArgonKey();
    $passwordWithKey = hash_hmac('sha256', $password, $key);
    return password_verify($passwordWithKey, $hashedPassword);
  }

  // Mã hóa sha-256
  public static function encodeSha256($data)
  {
    return hash('sha256', $data);
  }

  // ========================= AES-256-CBC (MÃ HÓA HAI CHIỀU) =========================

  // Mã hóa dữ liệu bằng AES-256-CBC
  public static function encodeAes($data)
  {
    $key = self::getAesKey();
    $iv = self::generateIv();

    $encrypted = openssl_encrypt($data, "AES-256-CBC", $key, 0, $iv);
    if ($encrypted === false) {
      throw new \Exception("Encryption failed.");
    }

    return base64_encode($iv . $encrypted);
  }

  // Giải mã dữ liệu bằng AES-256-CBC
  public static function decodeAes($encryptedData)
  {
    $key = self::getAesKey();
    $decoded = base64_decode($encryptedData);

    $ivLength = openssl_cipher_iv_length("AES-256-CBC");
    if (strlen($decoded) < $ivLength) {
      throw new \Exception("Invalid encrypted data.");
    }

    $iv = substr($decoded, 0, $ivLength);
    $ciphertext = substr($decoded, $ivLength);

    $decrypted = openssl_decrypt($ciphertext, "AES-256-CBC", $key, 0, $iv);
    if ($decrypted === false) {
      throw new \Exception("Decryption failed.");
    }

    return $decrypted;
  }
}
