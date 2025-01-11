<?php

class AuthMiddleware
{
    public function handle()
    {
        $auth = Auth::checkAuth();

        if (!$auth) {
            $result = Auth::reLogin();

            if (!$result) {
                Redirect::to('/login', 'Vui lòng đăng nhập!', 'error');
            } else {
                Redirect::reload();
            }
        }
    }


    
}
