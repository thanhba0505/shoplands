<?php

class PostController
{
    public function show()
    {
        $data = [
            'title' => 'Post Page',
        ];

        Session::set('test', 'Hello');
        Session::set('test2', 'World');

        Session::debug();

        echo Request::get('q');
        echo Request::get('b');

        View::make('Customer/post', $data, 'layout/layout-primary');
    }
}
