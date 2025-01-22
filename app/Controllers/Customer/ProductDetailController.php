<?php

class ProductDetailController
{
    public function show()
    {
        $id = Request::get('id');

        $data = [
            'title' => 'Product Detail Page',
            'id' => $id
        ];

        return View::make('Customer/product-detail', $data);
    }
}
