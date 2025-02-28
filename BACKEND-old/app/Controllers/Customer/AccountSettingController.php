<?php

class AccountSettingController
{
    public function show()
    {
        $data = [
            'title' => 'Thiết lập thông tin',
        ];

        return View::make('Customer/account-setting', $data, sidebar: 'account-setting');
    }
}
