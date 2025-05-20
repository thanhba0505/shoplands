<?php

namespace App\Controllers;

use App\Helpers\Log;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\SendMessage;
use App\Helpers\Validator;
use App\Models\ContactModel;

class ContactController {
    // Liên hệ
    public function create() {
        try {
            $name = Request::json('name');
            $phone = Request::json('phone');
            $topic = Request::json('topic');
            $content = Request::json('content');

            if (!$name || !$phone || !$topic || !$content) {
                Response::json(['message' => 'Vui lòng nhập đầy đủ thông tin'], 400);
            }

            $checkName = Validator::isName($name, 'Tên', 3, 20);
            if ($checkName !== true) {
                Response::json(['message' => $checkName], 400);
            }

            $checkPhone = Validator::isPhone($phone);
            if ($checkPhone !== true) {
                Response::json(['message' => $checkPhone], 400);
            }

            $checkContent = Validator::isText($content, 'Nội dung', 10, 500, true);
            if ($checkContent !== true) {
                Response::json(['message' => $checkContent], 400);
            }

            ContactModel::create($name, $phone, $topic, $content);

            Response::json(['message' => 'Liên hệ thành công, vui lòng chờ phản hồi trong vòng 1-3 ngày làm việc.'], 200);
        } catch (\Throwable $th) {
            Log::throwable("Controller -> contact: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Lấy danh sách liên hệ
    public function adminGet() {
        try {
            $type = Request::get('type') ? Request::get('type') : "all";
            $limit = Request::get('limit') ? Request::get('limit') : 10;
            $page = Request::get('page') ? Request::get('page') : 0;
            $search = Request::get('search') ? Request::get('search') : "";

            if (!in_array($type, ["all", "unreplied", "replied"])) {
                Response::json(['message' => 'Vui lòng nhập đúng loại liên hệ'], 400);
            }

            if ($type === "all") {
                $contacts = ContactModel::getAll($limit, $page, $search);
            } else if ($type === "unreplied") {
                $contacts = ContactModel::getUnreplied($limit, $page, $search);
            } else if ($type === "replied") {
                $contacts = ContactModel::getReplied($limit, $page, $search);
            }

            Response::json($contacts);
        } catch (\Throwable $th) {
            Log::throwable("Controller -> contact: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }

    // Trả lời liên hệ
    public function adminReply() {
        try {
            $id = Request::json('id');
            $content = Request::json('content');

            if (!$id || !$content) {
                Response::json(['message' => 'Vui lòng nhập đầy đủ thông tin'], 400);
            }

            $contact = ContactModel::getById($id);

            if (!$contact) {
                Response::json(['message' => 'Không tìm thấy liên hệ'], 400);
            }

            $checkContent = Validator::isText($content, 'Nội dung', 3, 500, true);
            if ($checkContent !== true) {
                Response::json(['message' => $checkContent], 400);
            }

            ContactModel::adminReply($id, $content);
            SendMessage::send($contact['phone'], $content);

            Response::json(['message' => 'Đã gửi phản hồi thành công'], 200);
        } catch (\Throwable $th) {
            Log::throwable("Controller -> contact: " . $th->getMessage());
            Response::json(['message' => 'Đã có lỗi xảy ra'], 500);
        }
    }
}
