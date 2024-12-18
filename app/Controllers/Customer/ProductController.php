<?php

class ProductController
{
    public function show()
    {
        $data = [
            'title' => 'Product Page',
        ];

        View::make('Customer/product', $data, 'layout/layout-primary');
    }
}
