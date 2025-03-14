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

        // Đọc toàn bộ nội dung file hiện tại
        $currentContent = '';
        if (file_exists(self::$logPath . $fileName)) {
            $currentContent = file_get_contents(self::$logPath . $fileName);
        }

        // Tạo log mới ở đầu file
        $newLog = '---------------------' . Carbon::now() . '---------------------' . PHP_EOL . $title . ' - ' . $logData . PHP_EOL . PHP_EOL;

        // Ghi log mới vào đầu file
        $fullContent = $newLog . $currentContent; // Thêm log mới vào đầu nội dung cũ

        // Ghi toàn bộ nội dung lại vào file
        if (false === file_put_contents(self::$logPath . $fileName, $fullContent)) {
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

    // Log debug
    public static function debug($logData, $title = '')
    {
        self::json($logData, $title, 'debug.log');
    }

    // Log throwable
    public static function throwable($logData, $title = '')
    {
        self::json($logData, $title, 'throwable.log');
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
