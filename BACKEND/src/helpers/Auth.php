<?php

namespace App\Helpers;

use App\Helpers\JwtHelper;
use App\Helpers\Request;
use App\Models\AccountModel;
use App\Models\UserModel;
use App\Models\SellerModel;


class Auth
{
    protected static $account = null;

    // ✅ Lấy thông tin tài khoản user từ token
    public static function user()
    {
        return self::getAuthenticatedAccount('user', UserModel::class);
    }

    // ✅ Lấy thông tin tài khoản seller từ token
    public static function seller()
    {
        return self::getAuthenticatedAccount('seller', SellerModel::class);
    }

    // 📌 Hàm chung lấy tài khoản theo vai trò & model
    protected static function getAuthenticatedAccount($role, $model)
    {
        if (self::$account !== null) {
            return self::$account;
        }

        // Lấy token từ header Authorization
        $authHeader = Request::getHeader('Authorization'); // 🔥 Cập nhật dùng request()
        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return null;
        }

        $accessToken = str_replace('Bearer ', '', $authHeader);

        // Kiểm tra có tồn tại token
        $account = AccountModel::findByAccessToken($accessToken);
        if (!$account || $account['role'] !== $role) {
            return null;
        }

        // Xác thực token
        $decoded = JwtHelper::verifyToken($accessToken);
        if (!$decoded) {
            return null;
        }

        // Gọi model tương ứng
        $account = $model::findById($decoded->account_id);
        if (!$account || $account['role'] !== $role) {
            return null;
        }

        self::$account = $account;
        return self::$account;
    }
}
