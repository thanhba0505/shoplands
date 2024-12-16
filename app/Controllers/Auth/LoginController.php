<?php

class LoginController
{
    public function show()
    {
        $sessiion = new Session();

        $sessiion->set('user', 'admin');
        echo $sessiion->get('user');
        
        View::make('Auth/login');
    }
}
