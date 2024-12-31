<?php

require_once 'app/Models/QueryDatabase.php';

class User extends QueryDatabase
{
    protected $table = 'users';

    // Lấy người dùng hiện tại
    public function getCurrentUser()
    {
        $accessToken = Cookie::get('access_token');

        $userId = Token::getUserId($accessToken);

        return $this->select()->where('id = ?', $userId)->first();
    }

    // Tìm người dùng theo số điện thoại
    public function findByPhone($phone)
    {
        return $this->select()->where('phone = ?', $phone)->first();
    }

    // Cập nhật Access Token và Refresh Token cho người dùng
    public function updateTokens($userId, $accessToken, $refreshToken)
    {
        // Đảm bảo rằng có truy vấn cơ sở trước khi gọi update
        return $this->where('id = ?', $userId)
            ->updateWithConditions([
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken
            ]);
    }


    // Tìm người dùng theo Refresh Token
    public function findByRefreshToken($refreshToken)
    {
        return $this->select()->where('refresh_token = ?', $refreshToken)->first();
    }

    // Xóa Access Token và Refresh Token bằng Refresh Token
    public function deleteTokensByRefreshToken($refreshToken)
    {
        return $this->where('refresh_token = ?', $refreshToken)->updateWithConditions([
            'access_token' => null,
            'refresh_token' => null
        ]);
    }
}
