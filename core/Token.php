<?php

require_once 'app/Models/User.php';

class Token
{
    private static $secretKey = SECRET_KEY; // Khóa bí mật

    // Tạo Access Token có chữ ký
    public static function createAccessToken($userId)
    {
        $payload = [
            'id' => $userId,
            'exp' => time() + ACCESS_TOKEN_EXPIRY, // Token hết hạn sau 1 giờ
        ];
        $payloadBase64 = base64_encode(json_encode($payload));
        $signature = hash_hmac('sha256', $payloadBase64, self::$secretKey);

        return $payloadBase64 . '.' . $signature;
    }


    // Tạo Refresh Token
    public static function createRefreshToken()
    {
        return bin2hex(random_bytes(32)); // Chuỗi ngẫu nhiên dài
    }

    // Xác thực Access Token
    public static function validateAccessToken($token)
    {
        $parts = explode('.', $token);
        if (count($parts) !== 2) {
            return false;
        }

        [$payloadBase64, $signature] = $parts;
        $expectedSignature = hash_hmac('sha256', $payloadBase64, self::$secretKey);

        if (!hash_equals($expectedSignature, $signature)) {
            return false; // Chữ ký không khớp
        }

        $payload = json_decode(base64_decode($payloadBase64), true);
        return $payload && $payload['exp'] > time(); // Token còn hạn
    }

    // Giải mã Access Token và lấy thông tin
    public static function getPayload($accessToken)
    {
        $check = self::validateAccessToken($accessToken);

        if (!$check) {
            return null;
        }

        $userModel = new User();
        $user = $userModel->findByAccessToken($accessToken);

        if (!$user) {
            return null;
        }

        $parts = explode('.', $accessToken);
        if (count($parts) !== 2) {
            return null;
        }

        $payloadBase64 = $parts[0];
        $payload = json_decode(base64_decode($payloadBase64), true);

        return $payload ?: null;
    }
}
