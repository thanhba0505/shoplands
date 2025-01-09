<?php

class AccountSettingsController
{
    public function show()
    {


        
        $data = [
            'title' => 'Thiết lập thông tin',
            'footer' => true,
            'sidebar' => 'info'
        ];

        View::make('Customer/account-settings', $data, 'layout/layout-sidebar');
    }
}
