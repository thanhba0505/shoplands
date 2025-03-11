<?php

namespace App\Helpers;

class Log
{
    protected static $logPath = 'src/logs/';

    protected static function writeLog($logData, $title, $fileName = 'global.log')
    {
        file_put_contents(self::$logPath . $fileName, '---------------------' . date('Y-m-d H:i:s') . '---------------------' . PHP_EOL . $title . ' - ' . $logData . PHP_EOL, FILE_APPEND);
    }

    public static function json($logData, $title = '', $fileName = 'global.log')
    {
        self::writeLog(json_encode($logData, JSON_PRETTY_PRINT), $title, $fileName);
    }

    // Log sms
    public static function sms($logData, $title = '', $fileName = 'sms.log')
    {
        self::json($logData, $title, $fileName);
    }
}
