<?php

namespace App\Controllers;

use App\Helpers\Response;
use App\Models\ConnectDatabase;

class Controller
{
    public function sql()
    {
        $conn = new ConnectDatabase();
        $sql = file_get_contents('.sql');
        $result = $conn->query($sql)->fetchAll();


        Response::json($result);
    }
}
