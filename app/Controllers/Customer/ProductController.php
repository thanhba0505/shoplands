<?php

class ProductController
{
    public function show()
    {
        $data = [
            'title' => 'Product Page',
        ];

        View::make('Customer/products', $data, 'layout/layout-primary');
    }
}
