<?php

require_once 'app/Models/QueryCustom.php';
require_once 'app/Models/User.php';

class Seller
{
    protected $table = 'sellers';

    // Lấy người bán hien tại
    public function getCurrentSeller()
    {
        $user = new User();
        $currentUser = $user->getCurrentUser();

        $query  = new QueryCustom();
        $result = $query
            ->select()
            ->from('sellers')
            ->where('user_id = :userId', ['userId' => $currentUser['id']])
            ->first();

        return $result;
    }

    // Kiểm tra có phải người bán
    public function isSeller($userId)
    {
        $query  = new QueryCustom();
        $result = $query
            ->select()
            ->from('sellers')
            ->where('user_id = :userId', ['userId' => $userId])
            ->first();

        return $result !== null;
    }


    
}
