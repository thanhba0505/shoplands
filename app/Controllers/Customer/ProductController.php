<?php

class ProductController
{
    public function index()
    {
        $data = [
            'title' => 'Product Page',
        ];

        View::make('Customer/product', $data, 'layout/layout-primary');
    }
}
