<?php

class ProductController
{
    public function show()
    {
        $data = [
            'title' => 'Product Page',
            'sidebar' => 'products'
        ];

        View::make('Customer/products', $data, 'layout/layout-sidebar');
    }
}
