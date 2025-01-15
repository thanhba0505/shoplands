<?php

class ErrorController
{
    public function show()
    {
        View::make('App/404', ['title' => '404 Not Found'], 'layout/layout-primary');
    }
}
