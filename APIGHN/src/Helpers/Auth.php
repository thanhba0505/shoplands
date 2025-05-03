<?php

namespace App\Helpers;

use App\Helpers\JWTHelper;
use App\Helpers\Request;
use App\Models\AccountModel;
use App\Models\UserModel;
use App\Models\SellerModel;


class Auth {
    protected static $account = null;

    // ✅ Lấy thông tin tài khoản user từ token
    public static function user() {
        return self::getAuthenticatedAccount('user', UserModel::class);
    }

    // ✅ Lấy thông tin tài khoản seller từ token
    public static function seller() {
        return self::getAuthenticatedAccount('seller', SellerModel::class);
    }

    // ✅ Lấy thông tin tài khoản shipper từ token
    public static function shipper() {
        return self::getAuthenticatedAccount('shipper', null);
    }

    // ✅ Lấy thông tin tài khoản admin từ token
    public static function admin() {
        return self::getAuthenticatedAccount('admin', null);
    }

    // 📌 Hàm chung lấy tài khoản theo vai trò & model
    protected static function getAuthenticatedAccount($role, $model) {
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
        $decoded = JWTHelper::verifyToken($accessToken);
        if (!$decoded) {
            return null;
        }

        // Gọi model tương ứng
        if ($role === 'user' || $role === 'seller') {
            $account = $model::findById($decoded->account_id);
            if (!$account || $account['role'] !== $role) {
                return null;
            }
        } else if ($role === 'admin') {
            $account = AccountModel::findById($decoded->account_id);
            if (!$account || $account['role'] !== $role) {
                return null;
            }
            $result['account_id'] = $account['account_id'];
            $result['phone'] = $account['phone'];
            $result['role'] = $account['role'];
            $result['status'] = $account['status'];
            $result['created_at'] = $account['created_at'];
            $account = $result;
        } 
        
        self::$account = $account;
        return self::$account;
    }
}
