<?php

namespace App\Helpers;

class Log
{
    protected static $logPath = 'src/logs/';

    // Kiểm tra và tạo thư mục nếu không tồn tại
    protected static function ensureLogPathExists()
    {
        if (!file_exists(self::$logPath)) {
            mkdir(self::$logPath, 0777, true); // Tạo thư mục với quyền ghi
        }
    }

    protected static function writeLog($logData, $title, $fileName = 'global.log')
    {
        self::ensureLogPathExists();  // Kiểm tra và tạo thư mục nếu cần

        // Cố gắng ghi log và kiểm tra nếu có lỗi
        if (false === file_put_contents(self::$logPath . $fileName, '---------------------' . date('Y-m-d H:i:s') . '---------------------' . PHP_EOL . $title . ' - ' . $logData . PHP_EOL, FILE_APPEND)) {
            // Nếu ghi không thành công, có thể thực hiện xử lý như gửi email hoặc log error
            error_log("Failed to write to log file: " . self::$logPath . $fileName);
        }
    }

    public static function json($logData, $title = '', $fileName = 'global.log')
    {
        self::writeLog(json_encode($logData, JSON_PRETTY_PRINT), $title, $fileName);
    }

    // Log global
    public static function global($logData, $title = '')
    {
        self::json($logData, $title, 'global.log');
    }

    // Log sms
    public static function sms($logData, $title = '')
    {
        self::json($logData, $title, 'sms.log');
    }

    // Log login
    public static function login($logData, $title = '')
    {
        self::json($logData, $title, 'login.log');
    }
}
