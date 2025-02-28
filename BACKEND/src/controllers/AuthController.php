<?php

namespace App\Controllers;

use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\JwtHelper;
use App\Models\AccountModel;

class AuthController
{
    public function login()
    {
        $phone = Request::post('phone');
        $password = Request::post('password');

        // Kiểm tra thông tin tài khoản
        $account = AccountModel::findByPhone($phone);
        if (!$account || !password_verify($password, $account['password'])) {
            Response::json(['message' => 'Sai số điện thoại hoặc mật khẩu'], 401);
        }

        // Tạo Access Token và Refresh Token
        $accessToken = JwtHelper::generateToken($account['id']);
        $refreshToken = JwtHelper::generateToken($account['id'], true);

        // Cập nhật token vào CSDL
        AccountModel::updateTokens($account['id'], $accessToken, $refreshToken);

        Response::json([
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken
        ]);
    }

    public function refreshToken()
    {
        $refreshToken = Request::post('refresh_token');

        // Kiểm tra token hợp lệ
        $decoded = JwtHelper::verifyToken($refreshToken);
        if (!$decoded) {
            Response::json(['message' => 'Refresh token không hợp lệ'], 401);
        }

        $account = AccountModel::findById($decoded->account_id);
        if (!$account || $account['refresh_token'] !== $refreshToken) {
            Response::json(['message' => 'Refresh token không hợp lệ'], 401);
        }

        // Tạo token mới
        $newAccessToken = JwtHelper::generateToken($account['id']);
        $newRefreshToken = JwtHelper::generateToken($account['id'], true);

        // Cập nhật token vào CSDL
        AccountModel::updateTokens($account['id'], $newAccessToken, $newRefreshToken);

        Response::json([
            'access_token' => $newAccessToken,
            'refresh_token' => $newRefreshToken
        ]);
    }

    public function logout()
    {
        // Lấy access token từ request
        $accessToken = Request::getHeader('Authorization');

        if (!$accessToken) {
            Response::json(['message' => 'Không tìm thấy access token'], 401);
        }

        // Loại bỏ 'Bearer ' nếu có
        $accessToken = str_replace('Bearer ', '', $accessToken);

        // Xác thực token
        $decoded = JwtHelper::verifyToken($accessToken);
        if (!$decoded) {
            Response::json(['message' => 'Access token không hợp lệ'], 401);
        }

        $account = AccountModel::findById($decoded->account_id);
        if (!$account) {
            Response::json(['message' => 'Access token không hợp lệ'], 401);
        }

        if (!$account['access_token']) {
            Response::json(['message' => 'Tài khoản đã đăng xuất'], 401);
        }

        if ($account['access_token'] !== $accessToken) {
            Response::json(['message' => 'Access token không hợp lệ'], 401);
        }

        // Lấy ID từ access token
        $id = $decoded->account_id;

        // Xóa access_token và refresh_token khỏi database
        AccountModel::updateTokens($id, null, null);

        Response::json(['message' => 'Đăng xuất thành công']);
    }
}
