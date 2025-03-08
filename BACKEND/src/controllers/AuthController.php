<?php

namespace App\Controllers;

use App\Helpers\Hash;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\JwtHelper;
use App\Helpers\Validator;
use App\Helpers\VerificationCode;
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

        if (!$account || !Hash::verifyArgon2i($password, $account['password'])) {
            Response::json(['message' => 'Sai số điện thoại hoặc mật khẩu'], 401);
        }

        // Tạo Access Token và Refresh Token
        $accessToken = JwtHelper::generateToken($account['account_id']);
        $refreshToken = JwtHelper::generateToken($account['account_id'], true);

        // Cập nhật token vào CSDL
        AccountModel::updateTokens($account['account_id'], $accessToken, $refreshToken);

        // Thông tin tài khoản
        if ($account['role'] == 'user') {
            $account = UserModel::findById($account['account_id']);
        } else if ($account['role'] == 'seller') {
            $account = SellerModel::findById($account['account_id']);
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
        $newAccessToken = JwtHelper::generateToken($account['account_id']);
        $newRefreshToken = JwtHelper::generateToken($account['account_id'], true);

        // Cập nhật token vào CSDL
        AccountModel::updateTokens($account['account_id'], $newAccessToken, $newRefreshToken);

        // Thông tin tài khoản
        if ($account['role'] == 'user') {
            $account = UserModel::findById($account['account_id']);
        } else if ($account['role'] == 'seller') {
            $account = SellerModel::findById($account['account_id']);
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
        $phone = Request::json('phone');
        $name = Request::json('name');
        $password = Request::json('password');
        $code = Request::json('code');

        // Kiểm tra tên tài khoản
        $nameCheck = Validator::isText($name, 'Tên tài khoản', 3, 20);
        if ($nameCheck !== true) {
            Response::json(['message' => $nameCheck], 400);
        }

        // Kiểm tra số điện thoại hợp lệ
        $phoneCheck = Validator::isPhone($phone);
        if ($phoneCheck !== true) {
            Response::json(['message' => $phoneCheck], 400);
        }

        // Kiểm tra độ mạnh của mật khẩu
        $passwordCheck = Validator::isPasswordStrength($password);
        if ($passwordCheck !== true) {
            Response::json(['message' => $passwordCheck], 400);
        }

        // Kiểm tra mã xác nhận
        $verificationCode = VerificationCodeModel::findByPhone(Validator::formatPhone($phone, '+84'));

        if (!$verificationCode) {
            Response::json(['message' => 'Số điện thoại không hợp lệ.'], 400);
        }

        if (!Hash::verifyArgon2i($code, $verificationCode['code'])) {
            Response::json(['message' => 'Mã xác nhận không khớp'], 400);
        }

        // Kiểm tra số điện thoại đã tồn tại chưa
        if (AccountModel::findByPhone($phone)) {
            Response::json(['message' => 'Số điện thoại đã được đăng ký'], 400);
        }

        // // Kiểm tra mã xác nhận đã hết hạn chưa
        // if (!VerificationCode::checkTime(strtotime($verificationCode['created_at']))) {
        //     Response::json(['message' => 'Mã xác nhận đã hết hạn'], 400);
        // }

        try {
            // Tạo tài khoản
            $resultAccount = AccountModel::addAccount($phone, $password);
            $newAccount = AccountModel::findByPhone($phone);
            $resultUser = UserModel::addUser($name, $newAccount['account_id']);

            if ($resultAccount !== false && $resultAccount->rowCount() > 0 && $resultUser !== false && $resultUser->rowCount() > 0) {
                Response::json(['message' => 'Đăng ký tài khoản thành công'], 201);
            } else {
                Response::json(['message' => 'Lỗi đăng ký tài khoản'], 400);
            }
        } catch (Exception $e) {
            Response::json(['message' => 'Lỗi đăng ký tài khoản'], 400);
        }
    }

    // Gửi mã xác nhận 
    public function sendVerificationCode()
    {
        $phoneNumber = Request::json('phone');

        // Kiểm tra số điện thoại hợp lệ
        $phoneCheck = Validator::isPhone($phoneNumber);
        if ($phoneCheck !== true) {
            Response::json(['message' => $phoneCheck], 400);
        }

        // Chuyển đổi số về định dạng +84
        $phoneNumber = Validator::formatPhone($phoneNumber, '+84');

        try {
            $resultSend = VerificationCode::sendCode($phoneNumber);

            if (!$resultSend) {
                Response::json(['message' => 'Gửi mã xác nhận thất bại'], 400);
            }

            // Kiểm tra số điện thoại đã có mã trước đó chưa
            if (VerificationCodeModel::findByPhone($phoneNumber)) {
                $result = VerificationCodeModel::updateVerificationCode(
                    $resultSend['message_id'],
                    $resultSend['code'],
                    $phoneNumber
                );
            } else {
                $result = VerificationCodeModel::addVerificationCode(
                    $resultSend['message_id'],
                    $resultSend['code'],
                    $phoneNumber
                );
            }

            if ($result !== false && $result->rowCount() > 0) {
                Response::json(['message' => 'Gửi mã xác nhận thành công'], 200);
            } else {
                Response::json(['message' => 'Đã xảy ra lỗi'], 400);
            }
        } catch (Exception $e) {
            Response::json(['message' => 'Đã có lỗi xảy ra'], 400);
        }
    }
}
