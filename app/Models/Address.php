<?php

require_once 'app/Models/QueryCustom.php';

class Address
{
    // Lấy địa chỉ theo user id
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
                p.name AS a_province,
                p.id AS p_id
            FROM
                addresses a
                JOIN provinces p ON p.id = a.province_id
            WHERE
                a.user_id = :userId
                AND a.default = :default
        ";

        $result = $query->query($sql, ['userId' => $userId, "default" => '1'])->fetch();

        return $result;
    }

    // Lấy địa_chi theo seller id
    public function getAddressBySellerId($sellerId)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT DISTINCT
                a.id AS a_id,
                a.address_line AS a_line,
                a.default AS a_default,
                a.seller_id AS s_id,
                a.user_id AS u_id,
                p.name AS a_province,
                p.id AS p_id
            FROM
                addresses a
                JOIN provinces p ON p.id = a.province_id
            WHERE
                a.seller_id = :sellerId
                AND a.default = :default
        ";

        $result = $query->query($sql, ['sellerId' => $sellerId, "default" => '1'])->fetch();

        return $result;
    }
}
