<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seller;
use App\Models\User;

class SellerSeeder extends Seeder {
    public function run(): void {
        $sellers = [
            [
                'store_name' => 'Thế Giới Thời Trang',
                'owner_name' => 'Phạm Thị Ngọc',
                'status' => 'approved',
                'description' => 'Cung cấp các sản phẩm thời trang cao cấp dành cho nam, nữ và trẻ em.',
                'background' => 'seller-1.jpg',
                'logo' => 'logo-1.jpg',
                'account_id' => 2,
            ],
            [
                'store_name' => 'Phụ Kiện Sành Điệu',
                'owner_name' => 'Hoàng Văn Bình',
                'status' => 'approved',
                'description' => 'Chuyên phụ kiện thời trang, trang sức và đồng hồ.',
                'background' => 'seller-2.jpg',
                'logo' => 'logo-2.jpg',
                'account_id' => 3,
            ],
            [
                'store_name' => 'Công Nghệ Số',
                'owner_name' => 'Nguyễn Thị Hạnh',
                'status' => 'approved',
                'description' => 'Nhà cung cấp thiết bị điện tử, điện thoại và máy tính hàng đầu.',
                'background' => 'seller-3.jpg',
                'logo' => 'logo-3.jpg',
                'account_id' => 4,
            ],
            [
                'store_name' => 'Nhà Cửa Online',
                'owner_name' => 'Trần Văn Minh',
                'status' => 'pending',
                'description' => 'Đầy đủ các sản phẩm phục vụ cho cuộc sống gia đình và nhà cửa.',
                'background' => 'seller-4.jpg',
                'logo' => 'logo-4.jpg',
                'account_id' => 5,
            ],
            [
                'store_name' => 'Thể Thao và Sách',
                'owner_name' => 'Phạm Thị Lan',
                'status' => 'rejected',
                'description' => 'Các sản phẩm thể thao và sách phục vụ nhu cầu giải trí và rèn luyện.',
                'background' => 'seller-5.jpg',
                'logo' => 'logo-5.jpg',
                'account_id' => 6,
            ],
        ];

        foreach ($sellers as $seller) {
            Seller::create($seller);
        }
    }

    // ========================= LẤY KHÓA BÍ MẬT =========================

    // Lấy khóa bí mật cho Argon2i từ .env
    private function getArgonKey() {
        return "shopee_argon";
    }

    // Lấy khóa bí mật cho AES-256 từ .env
    private function getAesKey() {

        // Lấy chuỗi key từ .env và chuyển thành key 32 bytes bằng SHA-256
        $rawKey = "shopee_aes";
        $key = hash('sha256', $rawKey, true); // true để trả về dạng nhị phân

        return $key;
    }

    // Tạo IV ngẫu nhiên cho AES-256
    private function generateIv() {
        return random_bytes(openssl_cipher_iv_length("AES-256-CBC"));
    }

    // ========================= PASSWORD_ARGON2I (MÃ HÓA MỘT CHIỀU) =========================

    // Mã hóa mật khẩu bằng PASSWORD_ARGON2I
    public function encodeArgon2i($password) {
        $key = self::getArgonKey();
        $passwordWithKey = hash_hmac('sha256', $password, $key);
        return password_hash($passwordWithKey, PASSWORD_ARGON2I);
    }

    // Kiểm tra mật khẩu với hash đã lưu
    public function verifyArgon2i($password, $hashedPassword) {
        $key = self::getArgonKey();
        $passwordWithKey = hash_hmac('sha256', $password, $key);
        return password_verify($passwordWithKey, $hashedPassword);
    }

    public static function encodeSha256($data) {
        return hash('sha256', $data);
    }

    // ========================= AES-256-CBC (MÃ HÓA HAI CHIỀU) =========================

    // Mã hóa dữ liệu bằng AES-256-CBC
    public function encodeAes($data) {
        $key = self::getAesKey();
        $iv = self::generateIv();

        $encrypted = openssl_encrypt($data, "AES-256-CBC", $key, 0, $iv);
        if ($encrypted === false) {
            throw new \Exception("Encryption failed.");
        }

        return base64_encode($iv . $encrypted);
    }

    // Giải mã dữ liệu bằng AES-256-CBC
    public function decodeAes($encryptedData) {
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
