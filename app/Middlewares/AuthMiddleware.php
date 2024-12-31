<?php

require_once 'app/Models/User.php';

class AuthMiddleware
{
    public function handle()
    {
        $accessToken  = Cookie::get('access_token');

        if (!$accessToken || !Token::validateAccessToken($accessToken)) {
            // echo 'Access token không hợp lệ!<br>';
            $this->refreshToken();
        }
    }


    public function refreshToken()
    {
        $refreshToken = Cookie::get('refresh_token');

        if (!$refreshToken) {
            Redirect::to('/login', 'Vui lòng đăng nhập!', 'error');
        }

        $userModel = new User();
        $user = $userModel->findByRefreshToken($refreshToken);

        if (!$user) {
            Redirect::to('/login', 'Vui lòng đăng nhập!', 'error');
        }

        // Tạo Token mới
        $accessToken = Token::createAccessToken($user['id']);
        $refreshToken = Token::createRefreshToken();

        $userModel->updateTokens($user['id'], $accessToken, $refreshToken);

        // Cập nhật Access Token trong Cookie
        Cookie::setToken($accessToken, $refreshToken);

        Redirect::reload();
    }
}
