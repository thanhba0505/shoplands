<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JwtHelper
{
    private static $secret_key;
    private static $expire_time;
    private static $refresh_expire_time;

    public static function init()
    {
        self::$secret_key = $_ENV['JWT_SECRET_KEY'];
        self::$expire_time = ACCESS_TOKEN_EXPIRY;
        self::$refresh_expire_time = REFRESH_TOKEN_EXPIRY;
    }

    public static function generateToken($account_ID, $isRefreshToken = false)
    {
        self::init();

        $payload = [
            'sub' => $account_ID,
            'iat' => time(),
            'exp' => time() + ($isRefreshToken ? self::$refresh_expire_time : self::$expire_time)
        ];

        return JWT::encode($payload, self::$secret_key, 'HS256');
    }

    public static function verifyToken($token)
    {
        self::init();

        if (empty($token)) {
            return null;
        }

        try {
            return JWT::decode($token, new Key(self::$secret_key, 'HS256'));
        } catch (Exception $e) {
            return null;
        }
    }
}
