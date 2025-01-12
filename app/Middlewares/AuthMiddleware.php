<?php

class AuthMiddleware
{
    public function handle()
    {
        $auth = Auth::checkAuth();

        if (!$auth) {
            $result = Auth::reLogin();

            if (!$result) {
                Redirect::login()->notification('Vui lòng đăng nhập!', 'error')->redirect();
            } else {
                Redirect::reload();
            }
        }
    }


    
}
