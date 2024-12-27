<?php

require_once 'app/Models/User.php';
// require_once 'core/Session.php';
// require_once 'core/Cookie.php';

class LoginController
{
    public function show()
    {
        View::make('Auth/login', [], 'layout/layout-auth');
    }

    public function login()
    {
        $phone = Request::post('phone');
        $password = Request::post('password');

        if (empty($phone) || empty($password)) {
            // return View::make('Auth/login', ['error' => 'Số điện thoại và mật khẩu không được để trống.'], 'layout/layout-auth');
            // header('Location: ' . BASE_URL . '/login');
            echo 'Số điện thoại và mật khẩu không được để trống';
            exit;
        }

        $userModel = new User();
        $user = $userModel->findByPhone($phone);

        if (!$user || !password_verify($password, $user['password'])) {
            // return View::make('Auth/login', ['error' => 'Số điện thoại hoặc mật khẩu không đúng.'], 'layout/layout-auth');
            // header('Location: ' . BASE_URL . '/login');
            echo 'Số điện thoại hoặc mật khẩu không đúng' . '<br>';
            exit;
        }

        // Tạo Access Token và Refresh Token
        $accessToken = Token::createAccessToken($user['id'], 'user');
        $refreshToken = Token::createRefreshToken();

        // Lưu token vào cơ sở dữ liệu
        $userModel->updateTokens($user['id'], $accessToken, $refreshToken);

        // Gửi Token qua Cookie
        $cookie = new Cookie();
        $cookie->setToken($accessToken, $refreshToken);

        echo 'Đăng nhập thành công: ' . $user['name'];
        $cookie->debug();
        exit;
    }

    public function logout()
    {
        $cookie = new Cookie();
        $cookie->removeToken();

        echo 'Đăng xuất thành công:';
        exit;
    }
}
