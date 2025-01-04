<?php

require_once 'app/Models/User.php';
// require_once 'core/Session.php';
// require_once 'core/Cookie.php';

class LoginController
{
    public function show()
    {
        View::make('Auth/login', [], 'layout/layout-primary');
    }

    public function login()
    {
        $phone = Request::post('phone');
        $password = Request::post('password');

        if (empty($phone) || empty($password)) {
            Redirect::to('/login', 'Số điện thoại và mật khẩu không được để trống.', 'error');
            exit;
        }

        $userModel = new User();
        $user = $userModel->findByPhone($phone);

        if (!$user || !password_verify($password, $user['password'])) {
            Redirect::to('/login', 'Số điện thoại hoặc mật khẩu không đúng.', 'error');
            exit;
        }

        // Tạo Access Token và Refresh Token
        $accessToken = Token::createAccessToken($user['id']);
        $refreshToken = Token::createRefreshToken();

        // Lưu token vào cơ sở dữ liệu
        $userModel->updateTokens($user['id'], $accessToken, $refreshToken);

        // Gửi Token qua Cookie
        Cookie::setToken($accessToken, $refreshToken);

        Redirect::to('/', 'Đăng nhập thành công.');
        exit;
    }

    public function logout()
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

        Redirect::to('/login', 'Đăng xuất thành công.');
        exit;
    }
}
