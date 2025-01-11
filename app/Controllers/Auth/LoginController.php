<?php

require_once 'app/Models/User.php';
// require_once 'core/Session.php';
// require_once 'core/Cookie.php';

class LoginController
{
    public function show()
    {
        View::make('Auth/login', ['title' => 'Đăng nhập'], 'layout/layout-primary');
    }

    public function login()
    {
        $phone = Request::post('phone');
        $password = Request::post('password');

        if (empty($phone) || empty($password)) {
            Redirect::back('Số điện thoại và mật khẩu không được để trống!', 'error');
        }

        $auth = Auth::login($phone, $password);

        if (!$auth) {
            Redirect::back('Số điện thoại hoặc mật khẩu không đúng!', 'error');
        }

        Redirect::to('/', 'Đăng nhập thành công.');
    }

    public function logout()
    {
        Auth::logout();

        Redirect::to('/login', 'Đăng xuất thành công.');
        exit;
    }
}
