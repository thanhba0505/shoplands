<?php

require_once 'app/Models/User.php';
require_once 'core/Session.php';
require_once 'core/Cookie.php';

class LoginController
{
    public function show()
    {
        // Hiển thị trang đăng nhập
        View::make('Auth/login', [], 'layout/layout-auth');
    }

    public function login()
    {
        $phone = $_POST['phone'];
        $password = $_POST['password'];

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

        $cookie = new Cookie();
        $cookie->set('user_id', $user['id'], 3600);
        echo 'Đăng nhận thành công: ' . $user['name'] . '<br>';

        // header('Location: ' . BASE_URL . '/');
        exit;
    }
}
