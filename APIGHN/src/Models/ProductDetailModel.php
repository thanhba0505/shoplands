<?php

namespace App\Models;

use App\Helpers\Response;
use App\Models\ConnectDatabase;

class ProductDetailModel {

    // Thêm danh sách chi tiết cho 1 sản phẩm
    public static function addList($product_id, $product_details) {
        $conn = new ConnectDatabase();

        $sql = "
            INSERT INTO
                product_details (product_id, name, description)
            VALUES
        ";

        $params = [];

        foreach ($product_details as $key => $product_detail) {
            $sql .= "(:product_id" . $key . ", :name" . $key . ", :description" . $key . ")";

            if ($key < count($product_details) - 1) {
                $sql .= ",";
            }

            $params['product_id' . $key] = $product_id;
            $params['name' . $key] = $product_detail['name'];
            $params['description' . $key] = $product_detail['description'];
        }

        $result = $conn->query($sql, $params);
        
        return $result;
    }








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
