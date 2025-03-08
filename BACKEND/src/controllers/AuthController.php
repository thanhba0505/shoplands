<?php

namespace App\Controllers;

use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\JwtHelper;
use App\Helpers\Validator;
use App\Helpers\Verification;
use App\Models\AccountModel;
use App\Models\SellerModel;
use App\Models\UserModel;
use App\Models\VerificationCodeModel;
use Exception;

class AuthController
{
    // Đăng nhập
    public function login()
    {
        $phone = Request::json('phone');
        $password = Request::json('password');

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

        // Thông tin tài khoản
        if ($account['role'] == 'user') {
            $account = UserModel::findById($account['id']);
        } else if ($account['role'] == 'seller') {
            $account = SellerModel::findById($account['id']);
        }

        Response::json([
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'account' => $account
        ]);
    }

    public function refreshToken()
    {
        $refreshToken = Request::json('refresh_token');

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

        // Thông tin tài khoản
        if ($account['role'] == 'user') {
            $account = UserModel::findById($account['id']);
        } else if ($account['role'] == 'seller') {
            $account = SellerModel::findById($account['id']);
        }

        Response::json([
            'access_token' => $newAccessToken,
            'refresh_token' => $newRefreshToken,
            'account' => $account
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

    // Đăng ký

    public function register()
    {
        $phoneNumber = Request::json('phone');
        $password = Request::json('password');

        if (!$phoneNumber || !$password) {
            Response::json(['message' => 'Số điện thoại hoặt mật khẩu rỗng'], 400);
        }

        if (!Validator::isPhone($phoneNumber)) {
            Response::json(['message' => 'Số điện thoại không đúng'], 400);
        }

        $validatePassword = Validator::isPasswordStrength($password);
        if ($validatePassword !== true) {
            Response::json(['message' => $validatePassword], 400);
        }


        Response::json(['message' => "Đăng ký thành công"], 400);
    }


    // Gửi mã xác nhận 
    public function sendVerificationCode()
    {
        $phoneNumber = Request::json('phone');

        if (!$phoneNumber) {
            Response::json(['message' => 'Số điện thoại không được rỗng', 'phone' => $phoneNumber], 400);
        }

        try {
            $resultSend = Verification::sendCode($phoneNumber);

            if (!$resultSend) {
                Response::json(['message' => 'Gửi má xác nhận thất bại'], 400);
            }

            $date = date('Y-m-d H:i:s');

            $result = VerificationCodeModel::addVerificationCode($resultSend['message_id'], $resultSend['code'], $date, $phoneNumber);

            if ($result->rowCount() > 0) {
                Response::json(['message' => 'Gửi mã xác nhận thành công', 'code' => $resultSend['code']], 200);
            } else {
                Response::json(['message' => 'Gửi mã xác nhận thất bại'], 400);
            }
        } catch (Exception $e) {
            Response::json(['message' => 'Gửi mã xác nhận thất bại'], 400);
        }
    }
}
