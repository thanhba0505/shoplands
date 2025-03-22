<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class ProductVariantValueModel {
    public static function getByProductVariantId($product_variant_id) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                pa.name,
                pav.value
            FROM
                product_variants pv
                LEFT JOIN product_variant_values pvv ON pvv.product_variant_id = pv.id
                JOIN product_attribute_values pav ON pav.id = pvv.product_attribute_value_id
                JOIN product_attributes pa ON pa.id = pav.product_attribute_id
            WHERE
                pv.id = :product_variant_id
        ";

        $result = $query->query($sql, ['product_variant_id' => $product_variant_id])->fetchAll();

        return $result;
    }

    // Thêm giá trị thuộc tính
    public static function add($product_variant_id, $product_attribute_value_id) {
        $query = new ConnectDatabase();

        $sql = "
            INSERT INTO
                product_variant_values (product_variant_id, product_attribute_value_id)
            VALUES
                (:product_variant_id, :product_attribute_value_id)
        ";

        $result = $query->query($sql, [
            'product_variant_id' => $product_variant_id,
            'product_attribute_value_id' => $product_attribute_value_id
        ]);

        return $result;
    }
}
