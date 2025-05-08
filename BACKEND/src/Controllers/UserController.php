<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\FileSave;
use App\Helpers\Response;
use App\Helpers\Log;
use App\Helpers\Request;
use App\Models\UserModel;

class UserController {
    // Admin lấy danh sách người bán
    public function adminGet() {
        try {
            $status = Request::get('status') && Request::get('status') != "all" ? Request::get('status') : "";
            $limit = Request::get('limit', 12);
            $page = Request::get('page', 0);

            $count = UserModel::countByStatus($status == "all" ? null : $status);
            $users = UserModel::getAll($status, $limit, $page);

            $result = [
                "count" => $count,
                "users" => $users
            ];

            Response::json($result);
        } catch (\Throwable $th) {
            Log::throwable("UserController -> adminGet: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy thông tin người mua
    public function userFind() {
        try {
            $user = Auth::user();

            Response::json($user);
        } catch (\Throwable $th) {
            Log::throwable("UserController -> userFind: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Tải ảnh avatar
    public function uploadAvatar() {
        try {
            $user = Auth::user();

            $avatarFile = Request::file('avatar');

            if (!$avatarFile) {
                Response::json(['message' => 'Không tìm thấy ảnh'], 400);
            }

            $logoUpload = FileSave::avatarImage($avatarFile);
            if ($logoUpload['success'] == false) {
                Response::json(['message' => $logoUpload['message']], 400);
            }

            UserModel::updateAvatar($user['user_id'], $logoUpload['file_name']);

            Response::json([
                'message' => 'Tải avatar lên thành công',
                'avatar' => $logoUpload['file_name']
            ], 200);
        } catch (\Throwable $th) {
            Log::throwable("UserController -> uploadAvatar: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
