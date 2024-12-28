<?php

class FormMiddleware
{
    public function handle()
    {
        if (!CSRF::validateToken(Request::post('csrf'))) {
            Session::set('error', 'CSRF Token không hợp lệ.');
            Redirect::to('/');
            exit;
        }
    }
}
