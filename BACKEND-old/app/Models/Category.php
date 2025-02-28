<?php

require_once 'app/Models/ConnectDatabase.php';

class Category
{

    public function getAll()
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                c.id, c.name, c.slug
            FROM
                categories c
        ";

        $result = $query->query($sql)->fetchAll();

        return $result;
    }

    public function getBySellerId($seller_id)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT DISTINCT
                c.id,
                c.name,
                c.slug
            FROM
                categories c
                JOIN products p ON p.category_id = c.id
                JOIN sellers s ON s.id = p.seller_id
            WHERE
                s.id = :seller_id
        ";

        $result = $query->query($sql, ['seller_id' => $seller_id])->fetchAll();

        return $result;
    }

    public function getCategoryByProductId($product_id)
    {
        $query = new ConnectDatabase();

        $sql =  "
            SELECT
                c.id, c.name, c.slug
            FROM
                categories c
                JOIN products p ON p.category_id = c.id
            WHERE
                p.id = :product_id
        ";

        $result = $query->query($sql, ['product_id' => $product_id])->fetch();

        return $result;
    }
}
