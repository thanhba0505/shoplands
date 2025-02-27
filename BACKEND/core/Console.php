<?php

class Console
{
    public static function log($data)
    {
        $jsonEncodedData = json_encode($data);
        echo "<script>document.addEventListener('DOMContentLoaded', () => {console.log($jsonEncodedData);});</script>";
    }

    public static function table($data)
    {
        $jsonEncodedData = json_encode($data);
        echo "<script>document.addEventListener('DOMContentLoaded', () => {console.table($jsonEncodedData);});</script>";
    }

    public static function error($data)
    {
        $jsonEncodedData = json_encode($data);
        echo "<script>document.addEventListener('DOMContentLoaded', () => {console.error($jsonEncodedData);});</script>";
    }
}
