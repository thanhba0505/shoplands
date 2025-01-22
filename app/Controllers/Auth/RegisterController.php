<?php

class RegisterController
{
    public function show()
    {
        return View::make('Auth/register', ['title' => 'Đăng ký']);
    }
}
