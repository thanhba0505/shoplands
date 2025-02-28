<?php

require_once 'app/Models/QueryCustom.php';

class ProductDetail
{
    // Lấy danh sách ảnh của sản phẩm theo id
    public function getDetailByProductId($product_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                pd.name AS name,
                pd.description AS description
            FROM
                product_details pd
            WHERE
                pd.product_id = :product_id
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetchAll();

        return $result;
    }
}
