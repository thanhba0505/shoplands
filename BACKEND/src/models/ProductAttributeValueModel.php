<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class ProductAttributeValueModel {
    // Tạo 1 thuộc tính
    public static function add($value, $product_attribute_id) {
        $conn = new ConnectDatabase();

        $sql =  "
            INSERT INTO
                product_attribute_values (value, product_attribute_id)
            VALUES
                (:value, :product_attribute_id)
        ";

        $conn->query($sql, [
            'value' => $value,
            'product_attribute_id' => $product_attribute_id
        ]);

        return $conn->getConnection()->lastInsertId();
    }
}
