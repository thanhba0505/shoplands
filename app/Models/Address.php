<?php

require_once 'app/Models/QueryCustom.php';

class Address
{
    // Lấy danh sách địa chỉ theo user id
    public function getAddressByUserId($userId)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT DISTINCT
                a.id AS a_id,
                a.address_line AS a_line,
                a.default AS a_default,
                a.seller_id AS s_id,
                a.user_id AS u_id,
                p.name AS a_province
            FROM
                addresses a
                JOIN provinces p ON p.id = a.province_id
            WHERE
                a.user_id = :userId
        ";

        $result = $query->query($sql, ['userId' => $userId])->fetchAll();

        return $result;
    }
}
