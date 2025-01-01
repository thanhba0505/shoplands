<?php

class RegisterController
{
    public function show()
    {
        View::make('Auth/login', [], 'layout/layout-header-simple-fullwidth');
    }
}
