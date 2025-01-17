<?php

use Illuminate\Redis\RedisServiceProvider;

require_once 'app/Models/User.php';
require_once 'app/Models/Seller.php';

class Auth
{
    public static function login($phone, $password)
    {
        try {
            if (empty($phone) || empty($password)) {
                return false;
            }

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

            // Lưu token vào cookie
            Cookie::setToken($accessToken, $refreshToken);

            return true;
        } catch (Exception $e) {
            error_log("Login Error: " . $e->getMessage());
            return false;
        }
    }

    public static function reLogin()
    {
        try {
            $refreshToken = Cookie::get('refresh_token');
            if (!$refreshToken) {
                return false;
            }

            $userModel = new User();
            $user = $userModel->findByRefreshToken($refreshToken);

            if (!$user) {
                return false;
            }

            // Tạo token mới
            $accessToken = Token::createAccessToken($user['id']);
            $newRefreshToken = Token::createRefreshToken();

            // Cập nhật token mới
            $userModel->updateTokens($user['id'], $accessToken, $newRefreshToken);
            Cookie::setToken($accessToken, $newRefreshToken);

            return true;
        } catch (Exception $e) {
            error_log("ReLogin Error: " . $e->getMessage());
            return false;
        }
    }

    public static function logout()
    {
        try {
            $refreshToken = Cookie::get('refresh_token');

            if ($refreshToken) {
                $userModel = new User();
                $userModel->deleteTokensByRefreshToken($refreshToken);
            }

            Cookie::removeToken();
            return true;
        } catch (Exception $e) {
            error_log("Logout Error: " . $e->getMessage());
            return false;
        }
    }

    public static function getUser()
    {
        try {
            $accessToken = Cookie::get('access_token');

            if (!$accessToken) {
                if (self::reLogin()) {
                    Redirect::reload();
                }
                return null;
            }

            $payload = Token::getPayload($accessToken);

            if (!$payload) {
                return null;
            }

            $userModel = new User();
            return $userModel->findById($payload['id']);
        } catch (Exception $e) {
            error_log("GetUser Error: " . $e->getMessage());
            return null;
        }
    }


    public static function checkAuth($role = 'user')
    {
        try {
            $accessToken = Cookie::get('access_token');

            if (!$accessToken) {
                if (self::reLogin()) {
                    Redirect::reload();
                }
                return false; 
            }

            $user = self::getUser();

            if (!$user) {
                return false;
            }

            if ($role === 'seller') {
                $sellerModel = new Seller();
                $seller = $sellerModel->findByUserId($user['id']);

                if (!$seller) {
                    return false;
                }
            }

            return true;
        } catch (Exception $e) {
            error_log("CheckAuth Error: " . $e->getMessage());
            return false;
        }
    }
}
