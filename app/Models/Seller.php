<?php

require_once 'app/Models/QueryDatabase.php';

class Seller extends QueryDatabase
{
    protected $table = 'sellers';

    // Tìm người dùng theo số điện thoại
    public function findByUserId($userId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = :user_id";
        return $this->query($sql, ['user_id' => $userId])->fetch();
    }

    public function isSeller($userId)
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE user_id = :user_id";
        $result = $this->query($sql, ['user_id' => $userId])->fetchColumn();
        return $result > 0;
    }
}
