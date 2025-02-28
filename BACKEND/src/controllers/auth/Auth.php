<?php

namespace App\Controllers\Auth;

use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\JwtHelper;
use App\Models\Account;

class Auth
{
    public function login()
    {
        $phone = Request::post('phone');
        $password = Request::post('password');

        // Kiểm tra thông tin tài khoản
        $account = Account::findByPhone($phone);
        if (!$account || !password_verify($password, $account['password'])) {
            Response::json(['message' => 'Sai số điện thoại hoặc mật khẩu'], 401);
        }

        // Tạo Access Token và Refresh Token
        $accessToken = JwtHelper::generateToken($account['id']);
        $refreshToken = JwtHelper::generateToken($account['id'], true);

        // Cập nhật token vào CSDL
        Account::updateTokens($account['id'], $accessToken, $refreshToken);

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

        $account = Account::findById($decoded->sub);
        if (!$account || $account['refresh_token'] !== $refreshToken) {
            Response::json(['message' => 'Refresh token không hợp lệ'], 401);
        }

        // Tạo token mới
        $newAccessToken = JwtHelper::generateToken($account['id']);
        $newRefreshToken = JwtHelper::generateToken($account['id'], true);

        // Cập nhật token vào CSDL
        Account::updateTokens($account['id'], $newAccessToken, $newRefreshToken);

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

        // Lấy ID từ access token
        $id = $decoded->sub;

        // Xóa access_token và refresh_token khỏi database
        Account::updateTokens($id, null, null);

        Response::json(['message' => 'Đăng xuất thành công']);
    }
}
