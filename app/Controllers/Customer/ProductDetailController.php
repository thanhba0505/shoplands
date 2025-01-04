<?php

class ProductDetailController
{
    public function show($id)
    {
        $data = [
            'title' => 'Product Detail Page',
            'id' => $id
        ];

        View::make('Customer/product-detail', $data, 'layout/layout-primary');
    }
}
