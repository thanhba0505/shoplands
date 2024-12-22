<?php

require_once 'app/Models/QueryDatabase.php';

class UserModel extends QueryDatabase
{
    protected $table = 'users';

    public function getTest($test)
    {
        // $sql = "SELECT * FROM {$this->table} WHERE email = :email";
        // return $this->query($sql, ['email' => $email])->fetch();
        return $test;
    }
}
