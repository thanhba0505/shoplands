<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\FileSave;
use App\Helpers\Response;
use App\Helpers\Log;
use App\Helpers\Request;
use App\Helpers\SendMessage;
use App\Helpers\Validator;
use App\Models\AccountModel;
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

    // Cập nhật tên tài khoản
    public function updateName() {
        try {
            $user = Auth::user();

            $name = Request::json('name');

            $nameCheck = Validator::isName($name, 'Tên tài khoản', 3, 20);
            if ($nameCheck !== true) {
                Response::json(['message' => $nameCheck], 400);
            }

            UserModel::updateName($user['user_id'], $name);

            Response::json([
                'message' => 'Cập nhật tên tài khoản thành công',
                'name' => $name
            ], 200);
        } catch (\Throwable $th) {
            Log::throwable("UserController -> updateName: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Admin khóa người mua
    public function adminLocked() {
        try {
            $user_id = Request::json('user_id');
            $locked = Request::json('locked');
            $reason = Request::json('reason');

            $user = UserModel::findByUserId($user_id);

            if (!$user) {
                Response::json(['message' => 'Không tìm thấy tài khoản'], 400);
            }

            if ($user['status'] === 'inactive') {
                Response::json(['message' => 'Tài khoản chưa hoạt động'], 400);
            }

            if ($user['status'] === 'unverified') {
                Response::json(['message' => 'Tài khoản chưa xác thực'], 400);
            }

            if ($locked) {
                AccountModel::lockedAccount($user['account_id']);

                // Send sms
                $mess = "Tài khoản '$user[name]' đã bị khóa";

                SendMessage::send(
                    $user['phone'],
                    $reason ? $reason : $mess
                );

                Response::json([
                    'message' => "Đã khóa tài khoản '$user[name]'",
                    'status' => 'locked'
                ]);
            } else {
                AccountModel::unlockAccount($user['account_id']);

                // Send sms
                $mess = "Tài khoản '$user[name]' đã được mở khóa";

                SendMessage::send(
                    $user['phone'],
                    $reason ? $reason : $mess
                );

                Response::json([
                    'message' => "Đã mở khóa tài khoản '$user[name]'",
                    'status' => 'active'
                ]);
            }
        } catch (\Throwable $th) {
            Log::throwable("UserController -> adminLocked: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
