<?php

namespace App\Models;

use App\Helpers\Carbon;
use App\Helpers\Hash;
use App\Helpers\Response;
use App\Models\ConnectDatabase;

class AccountModel {
    public static function findById($id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                a.id as account_id,
                a.phone,
                a.password,
                a.bank_number,
                a.bank_name,
                a.coin,
                a.role,
                a.status,
                a.created_at,
                a.device_token,
                a.access_token,
                a.refresh_token
            FROM
                accounts a
            WHERE
                a.id = :id
        ";

        $result = $query->query($sql, ['id' => $id])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
            $result['bank_number'] = Hash::decodeAes($result['bank_number']);
            $result['bank_name'] = Hash::decodeAes($result['bank_name']);
        }

        return $result;
    }

    public static function findByPhone($phone) {
        $phone = Hash::encodeSha256($phone);

        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                a.id as account_id,
                a.phone,
                a.password,
                a.role,
                a.bank_number,
                a.bank_name,
                a.status,
                a.coin,
                a.created_at,
                a.device_token,
                a.access_token,
                a.refresh_token
            FROM
                accounts a
            WHERE
                a.phoneHash = :phone
        ";

        $result = $query->query($sql, ['phone' => $phone])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
            $result['bank_number'] = Hash::decodeAes($result['bank_number']);
            $result['bank_name'] = Hash::decodeAes($result['bank_name']);
        }

        return $result;
    }

    public static function findByAccessToken($accessToken) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                a.id as account_id,
                a.phone,
                a.password,
                a.role,
                a.bank_number,
                a.bank_name,
                a.coin,
                a.status,
                a.created_at,
                a.device_token,
                a.access_token,
                a.refresh_token
            FROM
                accounts a
            WHERE
                a.access_token = :accessToken
        ";

        $result = $query->query($sql, ['accessToken' => $accessToken])->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
            $result['bank_number'] = Hash::decodeAes($result['bank_number']);
            $result['bank_name'] = Hash::decodeAes($result['bank_name']);
        }

        return $result;
    }

    public static function updateTokens($account_id, $accessToken, $refreshToken) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                accounts
            SET
                access_token = :accessToken,
                refresh_token = :refreshToken
            WHERE
                id = :account_id
        ";

        $result = $query->query($sql, [
            'accessToken' => $accessToken,
            'refreshToken' => $refreshToken,
            'account_id' => $account_id
        ]);

        return $result;
    }

    // Thêm 1 account
    public static function addAccount($phone, $password, $role = 'user', $status = 'active') {
        $query = new ConnectDatabase();

        $created_at = Carbon::now();
        $password = Hash::encodeArgon2i($password);
        $phoneHash = Hash::encodeSha256($phone);
        $phone = Hash::encodeAes($phone);

        $sql =  "
            INSERT INTO
                accounts (phone, phoneHash, password, role, created_at, status)
            VALUES
                (:phone, :phoneHash, :password, :role, :created_at, :status)
        ";

        $result = $query->query($sql, [
            'phone' => $phone,
            'phoneHash' => $phoneHash,
            'password' => $password,
            'role' => $role,
            'created_at' => $created_at,
            'status' => $status
        ]);

        return $result;
    }

    // Xóa account
    public static function delete($account_id) {
        $conn = new ConnectDatabase();

        $sql = "
            DELETE FROM accounts WHERE id = :account_id
        ";

        $result = $conn->query($sql, ['account_id' => $account_id]);

        return $result;
    }

    // Khóa account
    public static function lockedAccount($account_id) {
        $conn = new ConnectDatabase();

        $sql = "
            UPDATE accounts SET status = 'locked' WHERE id = :account_id
        ";

        $result = $conn->query($sql, ['account_id' => $account_id]);

        return $result;
    }

    // Mở khóa account
    public static function unlockAccount($account_id) {
        $conn = new ConnectDatabase();

        $sql = "
            UPDATE accounts SET status = 'active' WHERE id = :account_id
        ";

        $result = $conn->query($sql, ['account_id' => $account_id]);

        return $result;
    }

    // Thêm account người bán 
    public static function addAccountSeller($phone, $password, $bank_name, $bank_number, $role = 'seller', $status = 'inactive') {
        $conn = new ConnectDatabase();

        $created_at = Carbon::now();
        $password = Hash::encodeArgon2i($password);
        $phoneHash = Hash::encodeSha256($phone);
        $phone = Hash::encodeAes($phone);
        $bank_name = Hash::encodeAes($bank_name);
        $bank_number = Hash::encodeAes($bank_number);

        $sql =  "
            INSERT INTO
                accounts (phone, phoneHash, bank_name, bank_number, password, role, created_at, status)
            VALUES
                (:phone, :phoneHash, :bank_name, :bank_number, :password, :role, :created_at, :status)
        ";

        $conn->query($sql, [
            'phone' => $phone,
            'phoneHash' => $phoneHash,
            'password' => $password,
            'bank_name' => $bank_name,
            'bank_number' => $bank_number,
            'role' => $role,
            'created_at' => $created_at,
            'status' => $status
        ]);

        return $conn->getConnection()->lastInsertId();
    }

    // Kích hoạt tải khoản
    public static function activeAccount($account_id) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                accounts
            SET
                status = 'active'
            WHERE
                id = :account_id
        ";

        $result = $query->query($sql, ['account_id' => $account_id]);

        return $result;
    }

    // Câp nhật trạng thái
    public static function updateStatus($account_id, $status) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                accounts
            SET
                status = :status
            WHERE
                id = :account_id
        ";

        $result = $query->query($sql, ['status' => $status, 'account_id' => $account_id]);

        return $result;
    }

    // Cập nhật device_token
    public static function updateDeviceToken($account_id, $ip_address, $user_agent) {
        $query = new ConnectDatabase();

        $device_token = Hash::encodeArgon2i($ip_address . $user_agent);

        $sql = "
            UPDATE
                accounts
            SET
                device_token = :device_token
            WHERE
                id = :account_id
        ";

        $result = $query->query($sql, ['device_token' => $device_token, 'account_id' => $account_id]);

        return $result;
    }

    // Xóa device_token
    public static function deleteDeviceToken($account_id) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                accounts
            SET
                device_token = NULL
            WHERE
                id = :account_id
        ";

        $result = $query->query($sql, ['account_id' => $account_id]);

        return $result;
    }

    // Cập nhật password
    public static function updatePassword($account_id, $password) {
        $query = new ConnectDatabase();

        $password = Hash::encodeArgon2i($password);

        $sql = "
            UPDATE
                accounts
            SET
                password = :password
            WHERE
                id = :account_id
        ";

        $result = $query->query($sql, ['password' => $password, 'account_id' => $account_id]);

        return $result;
    }

    // Lấy account shipper
    public static function getShipper() {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                a.id as account_id,
                a.phone,
                a.role,
                a.bank_number,
                a.bank_name,
                a.status,
                a.coin,
                a.created_at
            FROM
                accounts a
            WHERE
                a.role = 'shipper'
        ";

        $result = $query->query($sql)->fetch();

        if ($result && isset($result['phone'])) {
            $result['phone'] = Hash::decodeAes($result['phone']);
            $result['bank_number'] = Hash::decodeAes($result['bank_number']);
            $result['bank_name'] = Hash::decodeAes($result['bank_name']);
        }

        return $result;
    }

    // Cộng coin cho seller
    public static function sellerIncreaseCoin($seller_id, $coin) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                accounts a
                JOIN sellers s ON s.account_id = a.id
            SET
                coin = coin + :coin
            WHERE
                s.id = :seller_id
        ";

        $result = $query->query($sql, [
            'coin' => $coin,
            'seller_id' => $seller_id
        ]);

        return $result;
    }

    // Cộng tiền cho admin
    public static function adminIncreaseCoin($coin) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE
                accounts a
            SET
                coin = coin + :coin
            WHERE
                a.id = 1
        ";

        $result = $query->query($sql, [
            'coin' => $coin,
        ]);

        return $result;
    }

    // Cập nhật ngân hàng
    public static function updateBank($account_id, $bank_name, $bank_number) {
        $query = new ConnectDatabase();

        $bank_name = Hash::encodeAes($bank_name);
        $bank_number = Hash::encodeAes($bank_number);

        $sql = "
            UPDATE
                accounts
            SET
                bank_name = :bank_name,
                bank_number = :bank_number
            WHERE
                id = :account_id
        ";

        $result = $query->query($sql, [
            'bank_name' => $bank_name,
            'bank_number' => $bank_number,
            'account_id' => $account_id
        ]);

        return $result;
    }

    // getAdminDashboard
    public static function getAdminDashboard() {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                SUM(a.coin) as total_coin,
                (SELECT SUM(a.coin) FROM accounts a WHERE a.role = 'admin') AS total_coin_admin,
                (SELECT SUM(a.coin) FROM accounts a WHERE a.role = 'seller') AS total_coin_seller,
                (SELECT COUNT(a.id) FROM accounts a WHERE a.role = 'seller') AS count_seller,
                (SELECT COUNT(a.id) FROM accounts a WHERE a.role = 'user') AS count_user,
                (SELECT COUNT(a.id) FROM products a) AS count_product
            FROM
                accounts a
        ";

        $result = $query->query($sql)->fetch();

        return $result;
    }
}
