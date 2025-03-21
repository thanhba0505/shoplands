<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class ProductDetailModel {
    // Lấy danh sách chi tiết sản phẩm theo id
    public static function getByProductId($product_id) {
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

    // Thêm chi tiết sản phẩm
    public static function add($product_id, $name, $description) {
        $conn = new ConnectDatabase();

        $sql = "
            INSERT INTO
                product_details (product_id, name, description)
            VALUES
                (:product_id, :name, :description)
        ";

        $result = $conn->query($sql, [
            'product_id' => $product_id,
            'name' => $name,
            'description' => $description
        ]);

        return $result;
    }
}
