<?php

require_once 'app/Models/QueryDatabase.php';

class User extends QueryDatabase
{
    protected $table = 'users';

    // Tìm người dùng theo số điện thoại
    public function findByPhone($phone)
    {
        $sql = "SELECT * FROM {$this->table} WHERE phone = :phone";
        return $this->query($sql, ['phone' => $phone])->fetch();
    }
}
