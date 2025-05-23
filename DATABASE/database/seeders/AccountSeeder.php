<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountSeeder extends Seeder {
    public function run(): void {
        Account::factory()->create([
            'phone' => $this->encodeAes('0833333333'),
            'phoneHash' => $this->encodeSha256("0833333333"),
            'password' => $this->encodeArgon2i('123'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        // for ($i = 0; $i < 5; $i++) {
        //     if ($i == 0) {
        //         Account::factory()->create([
        //             'phone' => $this->encodeAes('0822222222'),
        //             'phoneHash' => $this->encodeSha256("0822222222"),
        //             'password' => $this->encodeArgon2i('123'),
        //             'role' => 'seller',
        //             'status' => 'active',
        //         ]);
        //     } else {
        //         Account::factory()->create([
        //             'role' => 'seller',
        //             'status' => 'active',
        //         ]);
        //     }
        // }

        Account::factory()->create([
            'phone' => $this->encodeAes('0822222222'),
            'phoneHash' => $this->encodeSha256("0822222222"),
            'password' => $this->encodeArgon2i('123'),
            'role' => 'seller',
            'status' => 'active',
        ]);

        Account::factory()->create([
            'phone' => $this->encodeAes('0883468773'),
            'phoneHash' => $this->encodeSha256("0883468773"),
            'password' => $this->encodeArgon2i('fet3sd45w'),
            'role' => 'seller',
            'status' => 'active',
        ]);

        Account::factory()->create([
            'phone' => $this->encodeAes('0824666345'),
            'phoneHash' => $this->encodeSha256("0824666345"),
            'password' => $this->encodeArgon2i('sdfh356edrt'),
            'role' => 'seller',
            'status' => 'active',
        ]);

        Account::factory()->create([
            'phone' => $this->encodeAes('0822646477'),
            'phoneHash' => $this->encodeSha256("0822646477"),
            'password' => $this->encodeArgon2i('s723fkrsdfa'),
            'role' => 'seller',
            'status' => 'active',
        ]);

        Account::factory()->create([
            'phone' => $this->encodeAes('0829088908'),
            'phoneHash' => $this->encodeSha256("0829088908"),
            'password' => $this->encodeArgon2i('24dfuyu63u'),
            'role' => 'seller',
            'status' => 'active',
        ]);

        // User

        Account::factory()->create([
            'phone' => $this->encodeAes('0811111111'),
            'phoneHash' => $this->encodeSha256("0811111111"),
            'password' => $this->encodeArgon2i('123'),
            'role' => 'user',
            'status' => 'active',
        ]);

        Account::factory()->create([
            'phone' => $this->encodeAes('0811138364'),
            'phoneHash' => $this->encodeSha256("0811138364"),
            'password' => $this->encodeArgon2i('763gdu3ew5'),
            'role' => 'user',
            'status' => 'active',
        ]);

        Account::factory()->create([
            'phone' => $this->encodeAes('0887373235'),
            'phoneHash' => $this->encodeSha256("0887373235"),
            'password' => $this->encodeArgon2i('koiwer9823'),
            'role' => 'user',
            'status' => 'active',
        ]);

        Account::factory()->create([
            'phone' => $this->encodeAes('0866445533'),
            'phoneHash' => $this->encodeSha256("0866445533"),
            'password' => $this->encodeArgon2i('12sf234sdf3'),
            'role' => 'user',
            'status' => 'active',
        ]);

        Account::factory()->create([
            'phone' => $this->encodeAes('0839444478'),
            'phoneHash' => $this->encodeSha256("0839444478"),
            'password' => $this->encodeArgon2i('09jif8jr43'),
            'role' => 'user',
            'status' => 'active',
        ]);

        for ($i = 0; $i < 15; $i++) {
            Account::factory()->create([
                'role' => 'user',
                'status' => 'active',
            ]);
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
