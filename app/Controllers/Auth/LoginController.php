<?php

class LoginController
{
    public function show()
    {

        View::make('Auth/login', [], 'layout/layout-auth');
    }
}
