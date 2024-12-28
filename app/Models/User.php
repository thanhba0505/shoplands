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

    public function updateTokens($userId, $accessToken, $refreshToken)
    {
        $this->update($userId, [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
        ]);
    }

    public function findByRefreshToken($refreshToken)
    {
        $sql = "SELECT * FROM {$this->table} WHERE refresh_token = :refresh_token LIMIT 1";

        $stmt = $this->query($sql, ['refresh_token' => $refreshToken]);
        $session = $stmt->fetch();

        if (!$session) {
            return null;
        }

        return $session;
    }

    public function deleteTokensByRefreshToken($refreshToken)
    {
        $sql = "UPDATE users SET access_token = NULL, refresh_token = NULL WHERE refresh_token = :refresh_token";
        $this->query($sql, ['refresh_token' => $refreshToken]);
    }
}
