<?php

namespace App\Controllers;

use App\Models\ConnectDatabase;

class Controller
{
    public function sql()
    {
        $conn = new ConnectDatabase();
        $sql = file_get_contents('.sql');
        $products = $conn->query($sql)->fetchAll();


        header('Content-Type: application/json');
        echo json_encode($products);
    }
}
