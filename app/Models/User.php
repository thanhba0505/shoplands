<?php

require_once 'app/Models/QueryCustom.php';

class User
{
    // Tìm người dùng theo id
    public function findById($id)
    {
        $query  = new QueryCustom();
        $result = $query
            ->select()
            ->from('users')
            ->where('id = :id', ['id' => $id])
            ->first();

        return $result;
    }

    // Tìm người dùng theo id
    public function findByAccessToken($accessToken)
    {
        $query  = new QueryCustom();
        $result = $query
            ->select()
            ->from('users')
            ->where('access_token = :accessToken', ['accessToken' => $accessToken])
            ->first();

        return $result;
    }

    // Tìm người dùng theo số điện thoại
    public function findByPhone($phone)
    {
        $query  = new QueryCustom();
        $result = $query
            ->select()
            ->from('users')
            ->where('phone = :phone', ['phone' => $phone])
            ->first();

        return $result;
    }

    // Cập nhật Access Token và Refresh Token cho người dùng
    public function updateTokens($userId, $accessToken, $refreshToken)
    {
        $query  = new QueryCustom();
        $result = $query->update('users', [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken
        ], 'id = :id', [
            'id' => $userId
        ]);

        return $result;
    }


    // Tìm người dùng theo Refresh Token
    public function findByRefreshToken($refreshToken)
    {
        $query  = new QueryCustom();
        $result = $query
            ->select()
            ->from('users')
            ->where('refresh_token = :refreshToken', ['refreshToken' => $refreshToken])
            ->first();

        return $result;
    }

    // Xóa Access Token và Refresh Token bằng Refresh Token
    public function deleteTokensByRefreshToken($refreshToken)
    {
        $query  = new QueryCustom();
        $result = $query->update('users', [
            'access_token' => null,
            'refresh_token' => null
        ], 'refresh_token = :refreshToken', [
            'refreshToken' => $refreshToken
        ]);

        return $result;
    }
}
