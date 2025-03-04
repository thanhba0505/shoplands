<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class ProductDetailModel
{
    // Lấy danh sách chi tiết sản phẩm theo id
    public static function getByProductId($product_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                pd.name,
                pd.description
            FROM
                product_details pd
            WHERE
                pd.product_id = :product_id
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetchAll();

        return $result;
    }
}
