<?php

class PostController
{
    public function show()
    {
        $data = [
            'title' => 'Post Page',
        ];

        View::make('Customer/post', $data, 'layout/layout-primary');
    }
}
