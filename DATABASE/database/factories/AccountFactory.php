<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Account;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition(): array
    {
        $phone = $this->faker->unique()->numerify('09########');
        return [
            'phone'         => $this->encodeAes($phone), // Random số điện thoại VN
            'phoneHash'     => $this->encodeSha256($phone), // Random số điện thoại VN
            'password'      => $this->encodeArgon2i('password'), // Mặc định hash password là 'password'
            'role'          => $this->faker->randomElement(['user', 'seller', 'admin']), // Random vai trò
            'status'        => $this->faker->randomElement(['active', 'inactive', 'banned']), // Random trạng thái
            'created_at'    => $this->faker->dateTimeBetween('-5 year', '-1 year'), // Ngày tạo tài khoản
            'access_token'  => null, // Random access token
            'refresh_token' => null, // Random refresh token
        ];
    }

    // ========================= LẤY KHÓA BÍ MẬT =========================

    // Lấy khóa bí mật cho Argon2i từ .env
    private function getArgonKey()
    {
        return "shopee_argon";
    }

    // Lấy khóa bí mật cho AES-256 từ .env
    private function getAesKey()
    {

        // Lấy chuỗi key từ .env và chuyển thành key 32 bytes bằng SHA-256
        $rawKey = "shopee_aes";
        $key = hash('sha256', $rawKey, true); // true để trả về dạng nhị phân

        return $key;
    }

    // Tạo IV ngẫu nhiên cho AES-256
    private function generateIv()
    {
        return random_bytes(openssl_cipher_iv_length("AES-256-CBC"));
    }

    // ========================= PASSWORD_ARGON2I (MÃ HÓA MỘT CHIỀU) =========================

    // Mã hóa mật khẩu bằng PASSWORD_ARGON2I
    public function encodeArgon2i($password)
    {
        $key = self::getArgonKey();
        $passwordWithKey = hash_hmac('sha256', $password, $key);
        return password_hash($passwordWithKey, PASSWORD_ARGON2I);
    }

    // Kiểm tra mật khẩu với hash đã lưu
    public function verifyArgon2i($password, $hashedPassword)
    {
        $key = self::getArgonKey();
        $passwordWithKey = hash_hmac('sha256', $password, $key);
        return password_verify($passwordWithKey, $hashedPassword);
    }

    public static function encodeSha256($data)
    {
        return hash('sha256', $data);
    }

    // ========================= AES-256-CBC (MÃ HÓA HAI CHIỀU) =========================

    // Mã hóa dữ liệu bằng AES-256-CBC
    public function encodeAes($data)
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
    public function decodeAes($encryptedData)
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
