<?php

class RegisterController
{
    public function show()
    {
        View::make('Auth/register', [], 'layout/layout-primary');
    }
}
