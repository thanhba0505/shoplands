<?php

namespace App\Models;

use App\Helpers\Response;
use App\Models\ConnectDatabase;

class ProductImageModel {

    // Thêm 1 danh sách ảnh
    public static function addList($product_id, $image_paths) {
        $conn = new ConnectDatabase();

        $sql = "
            INSERT INTO
                product_images (product_id, image_path, `default`)
            VALUES
        ";

        $params = [];

        foreach ($image_paths as $key => $image_path) {
            $sql .= "(:product_id" . $key . ", :image_path" . $key . ", :default" . $key . ")";

            if ($key < count($image_paths) - 1) {
                $sql .= ",";
            }

            $params['product_id' . $key] = $product_id;
            $params['image_path' . $key] = $image_path;
            $params['default' . $key] = $key == 0 ? 1 : 0;
        }
        
        $result = $conn->query($sql, $params);

        return $result;
    }









    // Lấy danh sách ảnh của sản phẩm theo id
    public static function getByProductId($product_id) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                pi.image_path,
                pi.default
            FROM
                product_images pi
            WHERE
                pi.product_id = :product_id
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetchAll();

        return $result;
    }

    // Lấy danh ảnh mặc định
    public static function getDefault($product_id) {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                pi.image_path,
                pi.default
            FROM
                product_images pi
            WHERE
                pi.product_id = :product_id
                AND pi.default = :default
        ";

        $result = $query->query($sql, ['product_id' => $product_id, "default" => 1])->fetch();

        return $result['image_path'] ?? null;
    }

    // Thêm 1 ảnh
    public static function add($product_id, $image_path, $default = 0) {
        $conn = new ConnectDatabase();

        $sql = "
            INSERT INTO
                product_images (product_id, image_path, `default`)
            VALUES
                (:product_id, :image_path, :default)
        ";

        $result = $conn->query($sql, [
            'product_id' => $product_id,
            'image_path' => $image_path,
            'default' => $default
        ]);

        return $result;
    }
}
