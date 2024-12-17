<?php

class PostController
{
    public function index()
    {
        $data = [
            'title' => 'Post Page',
        ];

        View::make('Customer/post', $data, 'layout/layout-primary');
    }
}
