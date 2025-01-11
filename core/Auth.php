<?php

require_once 'app/Models/User.php';
require_once 'app/Models/Seller.php';

class Auth
{
    public static function login($phone, $password)
    {
        $userModel = new User();
        $user = $userModel->findByPhone($phone);

        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }

        // Tạo Access Token và Refresh Token
        $accessToken = Token::createAccessToken($user['id']);
        $refreshToken = Token::createRefreshToken();

        // Lưu token vào cơ sở dữ liệu
        $userModel->updateTokens($user['id'], $accessToken, $refreshToken);

        Cookie::setToken($accessToken, $refreshToken);
        return true;
    }

    public static function reLogin()
    {
        $refreshToken = Cookie::get('refresh_token');

        if (!$refreshToken) {
            return false;
        }
        
        $userModel = new User();
        $user = $userModel->findByRefreshToken($refreshToken);
        
        if (!$user) {
            return false;
        }
        
        // Tạo Token mới
        $accessToken = Token::createAccessToken($user['id']);
        $refreshToken = Token::createRefreshToken();

        $userModel->updateTokens($user['id'], $accessToken, $refreshToken);

        // Cập nhật Access Token trong Cookie
        Cookie::setToken($accessToken, $refreshToken);

        return true;
    }

    public static function logout()
    {
        // Lấy refresh_token từ cookie
        $refreshToken = Cookie::get('refresh_token');

        // Nếu tồn tại refresh_token, xóa khỏi CSDL
        if ($refreshToken) {
            $userModel = new User();
            $userModel->deleteTokensByRefreshToken($refreshToken);
        }

        // Xóa token trong cookie
        Cookie::removeToken();
        return true;
    }

    public static function getUser()
    {
        $accessToken = Cookie::get('access_token');

        $user = Token::getPayload($accessToken);

        if (!$user) {
            return null;
        }

        $userModel = new User();
        $user = $userModel->findById($user['id']);

        if (!$user) {
            return null;
        }

        return $user;
    }

    public static function checkAuth($roll = 'user')
    {
        $accessToken  = Cookie::get('access_token');

        if (!$accessToken || !Token::validateAccessToken($accessToken)) {
            return false;
        }

        $user = self::getUser();

        if ($roll == 'user' && !$user) {
            return false;
        }

        if ($roll == 'seller') {
            $sellerModel = new Seller();
            $seller = $sellerModel->findByUserId($user['id']);

            if (!$seller) {
                return false;
            }
        }
        return true;
    }
}
