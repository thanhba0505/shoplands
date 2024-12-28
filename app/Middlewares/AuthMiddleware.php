<?php

require_once 'app/Models/User.php';

class AuthMiddleware
{
    public function handle()
    {
        $accessToken  = Cookie::get('access_token');

        if (!$accessToken || !Token::validateAccessToken($accessToken)) {
            echo 'Access token không hợp lệ!<br>';
            $this->refreshToken();
        } else {
            echo 'Access Token hợp lệ!<br>';
        }
    }


    public function refreshToken()
    {
        $refreshToken = Cookie::get('refresh_token');

        if (!$refreshToken) {
            echo 'Refresh token làm mới không tồn tại!<br>';
            exit;
        }

        $userModel = new User();
        $user = $userModel->findByRefreshToken($refreshToken);

        if (!$user) {
            echo 'Refresh token làm mới không hợp lệ!<br>';
            exit;
        }

        // Tạo Token mới
        $accessToken = Token::createAccessToken($user['id'], 'user');
        $refreshToken = Token::createRefreshToken();

        $userModel->updateTokens($user['id'], $accessToken, $refreshToken);

        // Cập nhật Access Token trong Cookie
        Cookie::setToken($accessToken, $refreshToken);

        echo 'Access Token mới đã được tạo!';
        exit;
    }
}
