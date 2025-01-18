<?php

class ShopController
{
    public function show()
    {
        $id = Request::get('id');
        
        $data = [
            'title' => 'Shop Page',
            'id' => $id
        ];

        return View::make('Customer/shop', $data, 'layout/layout-primary');
    }
}
