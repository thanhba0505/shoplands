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
}
