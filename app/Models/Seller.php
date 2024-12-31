<?php

require_once 'app/Models/QueryDatabase.php';
require_once 'app/Models/User.php';

class Seller extends QueryDatabase
{
    protected $table = 'sellers';

    // Lấy người bán hien tại
    public function getCurrentSeller()
    {
        $user = new User();
        $currentUser = $user->getCurrentUser();
        return $this->select()->where('user_id = ?', $currentUser['id'])->first();
    }

    // Kiểm tra có phải người bán
    public function isSeller($userId)
    {
        $result = $this->select()->where('user_id = ?', $userId)->first(); 
        return $result !== null;
    }
}
