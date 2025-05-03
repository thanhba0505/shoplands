<?php

namespace App\Helpers;

class Request {
    // Phương thức kiểm tra request method
    public static function getMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }

    // Lấy giá trị từ $_POST
    public static function post($key, $default = null, $decodeJson = false) {

        // Kiểm tra nếu có giá trị trong $_POST với key là $key
        if (isset($_POST[$key])) {
            $data = $_POST[$key];

            // Giải mã nếu là chuỗi JSON và $decodeJson là true
            if ($decodeJson) {
                return json_decode($data, true);
            }
            
            return $data ?? $default;
        }

        // Nếu không có giá trị, trả về giá trị mặc định
        return $default;
    }

    // Lấy giá trị từ $_GET
    public static function get($value, $default = null) {
        if (isset($_GET[$value])) {
            $data = $_GET[$value];
            return is_array($data) && empty($data) ? ($default ?? []) : $data;
        }
        return $default;
    }

    // Lấy giá trị từ HTTP headers
    public static function getHeader($name, $default = null) {
        $headers = getallheaders();
        return $headers[$name] ?? $default;
    }

    // Lấy dữ liệu JSON từ body của request theo key hoặc tất cả nếu key là null
    public static function json($key = null, $default = null) {
        // Đảm bảo chỉ lấy dữ liệu khi content-type là application/json
        if (self::getHeader('Content-Type') === 'application/json') {
            $data = json_decode(file_get_contents('php://input'), true);

            // Nếu không có dữ liệu hoặc dữ liệu rỗng, trả về default
            if (empty($data)) {
                return $default;
            }

            // Nếu có key, trả về giá trị tương ứng với key, nếu không trả về toàn bộ dữ liệu
            return $key === null ? $data : ($data[$key] ?? $default);
        }
        return $default;
    }

    // Lấy giá trị từ $_SERVER
    public static function getServer($value, $default = null) {
        return $_SERVER[$value] ?? $default;
    }

    // Lấy giá trị từ $_FILES
    public static function file($key) {
        // Kiểm tra xem có file trong $_FILES với key là $key không
        if (isset($_FILES[$key])) {
            // Kiểm tra nếu có nhiều file (mảng) thì trả về null
            if (is_array($_FILES[$key]['name'])) {
                return null;  // Nếu có nhiều file, trả về null
            }

            // Nếu chỉ có một file, trả về thông tin file
            return $_FILES[$key];
        }

        return null;  // Nếu không có file, trả về null
    }


    public static function files($key) {
        // Kiểm tra xem có file trong $_FILES với key là $key không
        if (isset($_FILES[$key])) {
            // Kiểm tra nếu $_FILES[$key]['name'] là mảng (tải nhiều file)
            if (is_array($_FILES[$key]['name'])) {
                $files = $_FILES[$key];
                $result = [];

                // Duyệt qua các file trong mảng $_FILES[$key]
                foreach ($files['name'] as $key => $fileName) {
                    // Nếu có file và không có lỗi tải lên (UPLOAD_ERR_OK)
                    if ($files['error'][$key] === UPLOAD_ERR_OK) {
                        $result[] = [
                            'name' => $fileName,
                            'type' => $files['type'][$key],
                            'tmp_name' => $files['tmp_name'][$key],
                            'error' => $files['error'][$key],
                            'size' => $files['size'][$key]
                        ];
                    }
                }

                // Nếu không có file hợp lệ, trả về mảng rỗng
                return $result;
            } else {
                // Nếu không phải mảng, trả về mảng rỗng nếu không có file hợp lệ
                if ($_FILES[$key]['error'] === UPLOAD_ERR_OK) {
                    return [
                        [
                            'name' => $_FILES[$key]['name'],
                            'type' => $_FILES[$key]['type'],
                            'tmp_name' => $_FILES[$key]['tmp_name'],
                            'error' => $_FILES[$key]['error'],
                            'size' => $_FILES[$key]['size']
                        ]
                    ];
                }
            }
        }

        return [];  // Nếu không có file hoặc có lỗi, trả về mảng rỗng
    }
}
