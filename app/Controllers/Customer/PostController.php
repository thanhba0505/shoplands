<?php

class PostController
{
    public function show()
    {
        $data = [
            'title' => 'Post Page',
        ];

        return View::make('Customer/post', $data, 'layout/layout-primary');
    }
}
