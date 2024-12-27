<?php

class PostController
{
    public function show()
    {
        $cookie = new Cookie();

        $cookie->debug();

        echo '<h1>Post Page</h1>';

         // Ví dụ sử dụng Request::post
         $phone = '<>/?=-):{}';
         $password = '123Ơ}}.><';
 
         // Ví dụ sử dụng Request::get
         $name = Request::get('name');
 
         // Hiển thị giá trị đã mã hóa
         echo $phone;
         echo $password;
         echo $name;
        // $data = [
        //     'title' => 'Post Page',
        // ];

        // View::make('Customer/post', $data, 'layout/layout-primary');
    }
}
