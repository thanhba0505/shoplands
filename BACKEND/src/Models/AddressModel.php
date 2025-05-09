<?php

namespace App\Models;

use App\Helpers\Log;
use App\Models\ConnectDatabase;

class AddressModel {
    // Lấy danh sách địa chỉ theo account_id
    public static function getAllByAccountId($account_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT DISTINCT
                a.id AS address_id,
                a.address_line,
                a.default,
                a.province_id,
                a.province_name,
                a.district_id,
                a.district_name,
                a.ward_id,
                a.ward_name,
                a.account_id
            FROM
                addresses a
            WHERE
                a.account_id = :account_id
                AND a.deleted_at IS NULL
        ";

        $result = $query->query($sql, ['account_id' => $account_id])->fetchAll();

        return $result;
    }

    // Lấy danh sách địa chỉ theo seller_id
    public static function getAllBySellerId($seller_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT DISTINCT
                a.id AS address_id,
                a.address_line,
                a.default,
                a.province_id,
                a.province_name,
                a.district_id,
                a.district_name,
                a.ward_id,
                a.ward_name,
                a.account_id
            FROM
                addresses a
                JOIN sellers s ON s.id = a.account_id
            WHERE
                s.id = :seller_id
                AND a.deleted_at IS NULL
        ";

        $result = $query->query($sql, ['seller_id' => $seller_id])->fetchAll();

        return $result;
    }

    // Lấy địa chỉ mặc định theo account_id
    public static function findDefault($account_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT DISTINCT
                a.id AS address_id,
                a.address_line,
                a.default,
                a.province_id,
                a.province_name,
                a.district_id,
                a.district_name,
                a.ward_id,
                a.ward_name,
                a.account_id
            FROM
                addresses a
            WHERE
                a.account_id = :account_id
                AND a.default = :default
        ";

        $result = $query->query($sql, ['account_id,' => $account_id, "default" => '1'])->fetch();

        return $result;
    }

    // Lấy địa chỉ mặc định theo seller_id
    public static function findDefaultBySellerId($seller_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT DISTINCT
                a.id AS address_id,
                a.address_line,
                a.default,
                a.province_id,
                a.province_name,
                a.district_id,
                a.district_name,
                a.ward_id,
                a.ward_name,
                a.account_id
            FROM
                addresses a
                JOIN sellers s ON s.id = a.account_id
            WHERE
                s.id = :seller_id
        ";

        $result = $query->query($sql, ['seller_id' => $seller_id, "default" => '1'])->fetch();

        return $result;
    }

    // Lấy địa chỉ mặc định người bán theo id và seller_id
    public static function findFromAddress($seller_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT 
                a.id AS address_id,
                a.address_line,
                a.default,
                a.province_id,
                a.province_name,
                a.district_id,
                a.district_name,
                a.ward_id,
                a.ward_name,
                a.account_id
            FROM
                addresses a
                JOIN sellers s ON s.account_id = a.account_id
            WHERE
                s.id = :seller_id
                AND a.default = :default
        ";

        $result = $query->query($sql, ['seller_id' => $seller_id, "default" => '1'])->fetch();

        return $result;
    }

    // Lấy địa chỉ người mua
    public static function findToAddress($address_id, $user_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT 
                a.id AS address_id,
                a.address_line,
                a.default,
                a.province_id,
                a.province_name,
                a.district_id,
                a.district_name,
                a.ward_id,
                a.ward_name,
                a.account_id
            FROM
                addresses a
                JOIN users u ON u.account_id = a.account_id
            WHERE
                a.id = :address_id
                AND u.id = :user_id
        ";

        $result = $query->query($sql, ['address_id' => $address_id, 'user_id' => $user_id])->fetch();

        return $result;
    }

    // Lấy địa chỉ người bán
    public static function findSellerAddress($address_id, $seller_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT 
                a.id AS address_id,
                a.address_line,
                a.default,
                a.province_id,
                a.province_name,
                a.district_id,
                a.district_name,
                a.ward_id,
                a.ward_name,
                a.account_id
            FROM
                addresses a
                JOIN sellers s ON s.account_id = a.account_id
            WHERE
                a.id = :address_id
                AND s.id = :seller_id
        ";

        $result = $query->query($sql, ['address_id' => $address_id, 'seller_id' => $seller_id])->fetch();

        return $result;
    }

    // Thêm địa chỉ
    public static function create(
        $address_line,
        $default,
        $province_id,
        $province_name,
        $district_id,
        $district_name,
        $ward_id,
        $ward_name,
        $account_id
    ) {
        $conn = new ConnectDatabase();

        $sql = "
            INSERT INTO
                addresses (address_line, `default`, province_id, province_name, district_id, district_name, ward_id, ward_name, account_id)
            VALUES
                (:address_line, :default, :province_id, :province_name, :district_id, :district_name, :ward_id, :ward_name, :account_id)
        ";

        $conn->query($sql, [
            'address_line' => $address_line,
            'default' => $default,
            'province_id' => $province_id,
            'province_name' => $province_name,
            'district_id' => $district_id,
            'district_name' => $district_name,
            'ward_id' => $ward_id,
            'ward_name' => $ward_name,
            'account_id' => $account_id
        ]);

        return $conn->getConnection()->lastInsertId();
    }

    // Đặt địa chỉ mặc định theo account_id và address_id
    public static function setDefault($account_id, $address_id) {
        $conn = new ConnectDatabase();
        // Bắt đầu transaction
        $conn->beginTransaction();

        try {
            // Câu lệnh đầu tiên: Đặt tất cả các địa chỉ khác thành không phải mặc định
            $sql = "
                UPDATE 
                    addresses
                SET 
                    `default` = 0
                WHERE 
                    account_id = :account_id
                AND 
                    id != :address_id
            ";
            $conn->query($sql, ['account_id' => $account_id, 'address_id' => $address_id]);

            // Câu lệnh thứ hai: Đặt địa chỉ cụ thể làm mặc định
            $sql = "
                UPDATE 
                    addresses
                SET 
                    `default` = 1
                WHERE 
                    account_id = :account_id
                AND 
                    id = :address_id
            ";
            $result = $conn->query($sql, ['account_id' => $account_id, 'address_id' => $address_id]);

            // Kiểm tra nếu có bản ghi nào bị thay đổi
            if ($result->rowCount() > 0) {
                // Commit transaction nếu thành công
                $conn->commit();
                return true;  // Cập nhật thành công
            } else {
                // Nếu không có bản ghi nào bị thay đổi, rollback transaction
                $conn->rollBack();
                return false;  // Không có thay đổi
            }
        } catch (\Throwable $th) {
            Log::throwable("AddressModel -> setDefault: " . $th->getMessage());
            $conn->rollBack();
            return false;
        }
    }


    // Xóa địa chỉ theo account_id
    public static function delete($account_id, $address_id) {
        $query = new ConnectDatabase();

        $sql = "
            UPDATE 
                addresses
            SET 
                deleted_at = NOW()
            WHERE 
                account_id = :account_id
                AND id = :address_id
                AND `default` = 0
                AND deleted_at IS NULL
        ";

        $result = $query->query($sql, ['account_id' => $account_id, 'address_id' => $address_id]);

        return $result->rowCount() > 0 ? true : false;
    }

    // Xóa địa chỉ theo account_id
    public static function deleteAll($account_id) {
        $query = new ConnectDatabase();

        $sql = "
            DELETE FROM
                addresses
            WHERE
                account_id = :account_id
        ";

        $result = $query->query($sql, ['account_id' => $account_id]);

        return $result;
    }
}
