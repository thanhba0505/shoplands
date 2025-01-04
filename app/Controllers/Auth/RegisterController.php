<?php

class RegisterController
{
    public function show()
    {
        View::make('Auth/register', ['title' => 'Đăng ký'], 'layout/layout-primary');
    }
}
