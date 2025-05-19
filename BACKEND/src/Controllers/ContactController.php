<?php

namespace App\Controllers;

use App\Helpers\Log;
use App\Helpers\Request;
use App\Helpers\Response;
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
}
