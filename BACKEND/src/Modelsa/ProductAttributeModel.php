<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class ProductAttributeModel {
    // Tạo 1 thuộc tính
    public static function add($name) {
        $conn = new ConnectDatabase();

        $sql =  "
            INSERT INTO
                product_attributes (name)
            VALUES
                (:name)
        ";

        $conn->query($sql, [
            'name' => $name
        ]);

        return $conn->getConnection()->lastInsertId();
    }
}
