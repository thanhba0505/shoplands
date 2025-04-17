<?php

namespace App\Models;

use App\Models\ConnectDatabase;

class CategoryModel {
    // Lấy danh sách danh mục
    public static function getAll() {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                c.id, 
                c.name, 
                c.slug,
                c.image_path
            FROM
                categories c
        ";

        $result = $query->query($sql)->fetchAll();

        return $result;
    }

    // Lấy danh mục theo product_id
    public static function getByProductId($product_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                c.id as category_id, 
                c.name, 
                c.slug,
                c.image_path
            FROM
                categories c
                JOIN products p ON p.category_id = c.id
            WHERE
                p.id = :product_id
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetch();

        return $result;
    }

    // Lấy danh mục theo category_id
    public static function find($category_id) {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                c.id as category_id, 
                c.name, 
                c.slug,
                c.image_path
            FROM
                categories c
            WHERE
                c.id = :category_id
        ";

        $result = $query->query($sql, ['category_id' => $category_id])->fetch();

        return $result;
    }
}
