<?php

require_once 'app/Models/ConnectDatabase.php';

class ShippingFee
{

    public function getFeesBySameProvince($same_province)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT DISTINCT
                sf.id AS sf_id,
                sf.shipping_method AS sf_method,
                sf.same_province AS sf_same_province,
                sf.shipping_fee AS sf_fee
            FROM
                shipping_fees sf
            WHERE
                sf.same_province = :same_province
        ";

        $result = $query->query($sql, ['same_province' => $same_province])->fetchAll();

        return $result;
    }
}
