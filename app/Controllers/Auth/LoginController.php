<?php

require_once 'app/Models/User.php';
// require_once 'core/Session.php';
// require_once 'core/Cookie.php';

class LoginController
{
    public function show()
    {
        return View::make('Auth/login', ['title' => 'Đăng nhập'], 'layout/layout-primary');
    }

    public function login()
    {
        $phone = Request::post('phone');
        $password = Request::post('password');

        if (empty($phone) || empty($password)) {
            Redirect::back()->notification('Số điện thoại và mật khẩu không được để trống', 'error')->redirect();
        }

        $auth = Auth::login($phone, $password);

        if (!$auth) {
            Redirect::back()->notification('Số điện thoại hoặc mật khẩu không đúng', 'error')->redirect();
        }

        Redirect::home()->notification('Đăng nhập thành công')->redirect();
    }

    public function logout()
    {
        Auth::logout();

        Redirect::login()->notification('Đăng xuất thành công')->redirect();
        exit;
    }
}
