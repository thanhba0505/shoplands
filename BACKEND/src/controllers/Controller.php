<?php

namespace App\Controllers;

use App\Helpers\Carbon;
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

    public function insertMessage($content, $code, $account_id)
    {
        $conn = new ConnectDatabase();

        $created_at = Carbon::now();

        $sql = "
            INSERT INTO 
                messages (content, code, account_id, created_at) 
            VALUES 
                (:content, :code, :account_id, :created_at)
        ";

        $result = $conn->query($sql, [
            ':content' => $content,
            ':code' => $code,
            ':account_id' => $account_id,
            ':created_at' => $created_at
        ]);

        Response::json($result);
    }
}
