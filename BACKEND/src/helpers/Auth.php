<?php

namespace App\Helpers;

use App\Helpers\JwtHelper;
use App\Models\UserModel;
use App\Models\SellerModel;

class Auth
{
    protected static $user = null;

    // ✅ Lấy thông tin user từ token
    public static function user()
    {
        return self::getAuthenticatedUser('user', UserModel::class);
    }

    // ✅ Lấy thông tin seller từ token
    public static function seller()
    {
        return self::getAuthenticatedUser('seller', SellerModel::class);
    }

    // 📌 Hàm chung lấy user theo vai trò & model
    protected static function getAuthenticatedUser($role, $model)
    {
        if (self::$user !== null) {
            return self::$user;
        }

        // Lấy token từ header Authorization
        $authHeader = Request::getHeader('Authorization');
        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return null;
        }

        $accessToken = str_replace('Bearer ', '', $authHeader);

        // Xác thực token
        $decoded = JwtHelper::verifyToken($accessToken);
        if (!$decoded) {
            return null;
        }

        // Gọi model tương ứng
        $user = $model::findById($decoded->account_id);
        if (!$user || $user['role'] !== $role) {
            return null;
        }

        self::$user = $user;
        return self::$user;
    }
}
