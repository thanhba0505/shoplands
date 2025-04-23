<?php

namespace App\Helpers;

class Log {
    protected static $logPath = 'src/logs/';

    // Kiểm tra và tạo thư mục nếu không tồn tại
    protected static function ensureLogPathExists() {
        if (!file_exists(self::$logPath)) {
            mkdir(self::$logPath, 0777, true); // Tạo thư mục với quyền ghi
        }
    }

    protected static function writeLog($logData, $title, $fileName = 'global.log') {
        self::ensureLogPathExists();  // Kiểm tra và tạo thư mục nếu cần

        // Đọc toàn bộ nội dung file hiện tại
        $currentContent = '';
        if (file_exists(self::$logPath . $fileName)) {
            $currentContent = file_get_contents(self::$logPath . $fileName);
        }

        // Tạo log mới ở đầu file, đảm bảo giữ lại định dạng ngữ nghĩa của dữ liệu
        $newLog = '---------------------' . Carbon::now() . '---------------------' . PHP_EOL . $title . ' - ' . $logData . PHP_EOL . PHP_EOL;

        // Ghi log mới vào đầu file
        $fullContent = $newLog . $currentContent; // Thêm log mới vào đầu nội dung cũ

        // Ghi toàn bộ nội dung lại vào file
        if (false === file_put_contents(self::$logPath . $fileName, $fullContent)) {
            // Nếu ghi không thành công, có thể thực hiện xử lý như gửi email hoặc log error
            error_log("Failed to write to log file: " . self::$logPath . $fileName);
        }
    }

    public static function json($logData, $title = '', $fileName = 'global.log') {
        // Sử dụng JSON_UNESCAPED_UNICODE để đảm bảo không mã hóa ký tự Unicode
        self::writeLog(json_encode($logData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), $title, $fileName);
    }


    // Log global
    public static function global($logData, $title = 'Global:') {
        self::json($logData, $title, 'global.log');
    }

    // Log debug
    public static function debug($logData, $title = 'Debug:') {
        self::json($logData, $title, 'debug.log');
    }

    // Log throwable
    public static function throwable($logData, $title = 'Throwable:') {
        self::json($logData, $title, 'throwable.log');
    }

    // Log sms
    public static function sms($logData, $title = 'SMS:') {
        self::json($logData, $title, 'sms.log');
    }

    // Log login
    public static function login($logData, $title = 'Login:') {
        self::json($logData, $title, 'login.log');
    }

    // Log auto run delete order unpaid
    public static function autoRunUpdateOrder($logData, $title = 'Update Order:') {
        self::json($logData, $title, 'auto-run-update-order.log');
    }

    // Log count sql
    public static function sql(string $logData, $title = 'SQL:') {
        $cleanString = preg_replace('/\s+/', ' ', $logData);
        $cleanString = trim($cleanString);
        self::json($cleanString, $title, 'sql.log');
    }
}
