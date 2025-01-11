<?php

require_once 'app/Models/QueryCustom.php';
require_once 'app/Models/User.php';

class Seller
{
    public function findByUserId($userId)
    {
        $query  = new QueryCustom();
        $result = $query
            ->select()
            ->from('sellers')
            ->where('user_id = :id', ['id' => $userId])
            ->first();

        return $result;

    }


    
}
