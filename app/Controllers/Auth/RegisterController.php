<?php

class RegisterController
{
    public function show()
    {
        $session = new Session();
        $session->remove('user');
        View::make('Auth/register');
    }
}
