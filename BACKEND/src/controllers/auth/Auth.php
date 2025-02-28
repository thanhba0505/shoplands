<?php

namespace App\Controllers\Auth;

use App\Helpers\Request;
use App\Helpers\Response;
use App\Models\User; 
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class Auth
{
    private $secretKey = $_ENV['JWT_SECRET_KEY']; // Thay bằng key mạnh hơn (lưu trong .env)

    // 🔹 API LOGIN
    public function login()
    {
        $phone = Request::post('phone');
        $password = Request::post('password');
        $role = Request::post('role');

        // Kiểm tra dữ liệu đầu vào
        if (!$phone || !$password || !$role) {
            return Response::json(["success" => false, "message" => "Thiếu thông tin đăng nhập"], 400);
        }

        // Xử lý kiểm tra tài khoản trong database (viết logic trong model)
        $user = User::findByPhoneAndRole($phone, $role);
        if (!$user || !password_verify($password, $user['password'])) {
            return Response::json(["success" => false, "message" => "Sai tài khoản hoặc mật khẩu"], 401);
        }

        // Tạo accessToken & refreshToken
        $accessToken = $this->generateToken($user, 3600); // 1 tiếng
        $refreshToken = $this->generateToken($user, 604800); // 7 ngày

        // Lưu refreshToken vào DB (tự xử lý trong model)
        User::storeRefreshToken($user['id'], $refreshToken);

        return Response::json([
            "success" => true,
            "accessToken" => $accessToken,
            "refreshToken" => $refreshToken
        ]);
    }

    // 🔹 API REFRESH TOKEN
    public function refreshToken()
    {
        $refreshToken = Request::post('refreshToken');

        if (!$refreshToken) {
            return Response::json(["success" => false, "message" => "Thiếu refreshToken"], 400);
        }

        try {
            $decoded = JWT::decode($refreshToken, new Key($this->secretKey, 'HS256'));
            $user = User::findById($decoded->id);

            if (!$user || !User::isRefreshTokenValid($user['id'], $refreshToken)) {
                return Response::json(["success" => false, "message" => "Refresh Token không hợp lệ"], 401);
            }

            // Cấp token mới
            $newAccessToken = $this->generateToken($user, 3600);
            return Response::json(["success" => true, "accessToken" => $newAccessToken]);
        } catch (Exception $e) {
            return Response::json(["success" => false, "message" => "Token không hợp lệ"], 401);
        }
    }

    // 🔹 API LOGOUT
    public function logout()
    {
        $userId = Request::post('userId');

        if (!$userId) {
            return Response::json(["success" => false, "message" => "Thiếu userId"], 400);
        }

        // Xóa refreshToken khỏi DB
        User::clearRefreshToken($userId);
        
        return Response::json(["success" => true, "message" => "Đăng xuất thành công"]);
    }

    // 📌 Hàm tạo JWT Token
    private function generateToken($user, $expiry)
    {
        $payload = [
            "id" => $user['id'],
            "phone" => $user['phone'],
            "role" => $user['role'],
            "exp" => time() + $expiry
        ];
        return JWT::encode($payload, $this->secretKey, 'HS256');
    }
}
