<?php

namespace App\Helpers;

class VNPAY {
  // Thông tin cấu hình VNPAY
  private static $vnp_TmnCode; // Mã định danh merchant kết nối
  private static $vnp_HashSecret; // Secret key
  private static $vnp_Url; // URL thanh toán
  private static $vnp_ReturnUrl = BASE_URL . "/api/user/orders/check-payment"; // URL trả kết quả
  private static $vnp_Expire = 15; // Thời gian hết hạn thanh toán (minutes)

  public static function init() {
    self::$vnp_Url = $_ENV['VNPAY_URL'];
    self::$vnp_TmnCode = $_ENV['VNPAY_TMN_CODE'];
    self::$vnp_HashSecret = $_ENV['VNPAY_HASH_SECRET'];
  }

  /**
   * Tạo URL thanh toán
   */
  public static function createPaymentUrl($amount, $language = "vn", $bankCode = null) {
    self::init();
    $vnp_TxnRef = time() . rand(10000, 99999); // Mã giao dịch thanh toán tham chiếu của merchant
    $startTime = date("YmdHis"); // Thời gian tạo giao dịch
    $expire = date('YmdHis', strtotime('+' . self::$vnp_Expire . ' minutes', strtotime($startTime))); // Thời gian hết hạn

    $inputData = array(
      "vnp_Version" => "2.1.0",
      "vnp_TmnCode" => self::$vnp_TmnCode,
      "vnp_Amount" => $amount * 100, // Số tiền thanh toán (VND)
      "vnp_Command" => "pay",
      "vnp_CreateDate" => date('YmdHis'),
      "vnp_CurrCode" => "VND",
      "vnp_IpAddr" => $_SERVER['REMOTE_ADDR'],
      "vnp_Locale" => $language,
      "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
      "vnp_OrderType" => "other",
      "vnp_ReturnUrl" => self::$vnp_ReturnUrl,
      "vnp_TxnRef" => $vnp_TxnRef,
      "vnp_ExpireDate" => $expire
    );

    if ($bankCode) {
      $inputData['vnp_BankCode'] = $bankCode;
    }

    // Sắp xếp lại mảng để đảm bảo thứ tự các tham số
    ksort($inputData);
    $query = "";
    $hashdata = "";
    $i = 0;
    foreach ($inputData as $key => $value) {
      $query .= urlencode($key) . "=" . urlencode($value) . '&';
      if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
      } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
      }
    }

    $vnp_Url = self::$vnp_Url . "?" . $query;
    if (isset(self::$vnp_HashSecret)) {
      $vnpSecureHash = hash_hmac('sha512', $hashdata, self::$vnp_HashSecret);
      $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }

    return [
      "vnp_url" => $vnp_Url,
      "vnp_txnref" => $vnp_TxnRef
    ];
  }

  /**
   * Xử lý kết quả trả về từ VNPAY
   */
  public static function handleReturn() {
    self::init();
    $inputData = array();
    $returnData = array();

    // Lấy tất cả dữ liệu từ $_GET và lưu vào mảng $inputData
    foreach ($_GET as $key => $value) {
      if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
      }
    }

    $vnp_SecureHash = $inputData['vnp_SecureHash'];
    unset($inputData['vnp_SecureHash']); // Xóa vnp_SecureHash khỏi dữ liệu gốc để tính toán hash

    // Sắp xếp dữ liệu theo thứ tự chữ cái để tạo hash
    ksort($inputData);
    $hashData = "";
    $i = 0;
    foreach ($inputData as $key => $value) {
      if ($i == 1) {
        $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
      } else {
        $hashData .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
      }
    }

    // Tính toán hash để kiểm tra tính hợp lệ của dữ liệu
    $secureHash = hash_hmac('sha512', $hashData, self::$vnp_HashSecret);

    try {
      // Kiểm tra checksum của dữ liệu (so sánh hash tính toán với hash từ VNPAY)
      if ($secureHash == $vnp_SecureHash) {
        // Kiểm tra kết quả thanh toán từ VNPAY
        if ($inputData['vnp_ResponseCode'] == '00' && $inputData['vnp_TransactionStatus'] == '00') {
          $returnData['code'] = '00';
          $returnData['message'] = self::getErrorMessage('00');
        } else {
          // Trả về các mã lỗi cụ thể dựa trên mã lỗi của VNPAY
          $errorCode = $inputData['vnp_ResponseCode'];
          $returnData['code'] = $errorCode;
          $returnData['message'] = self::getErrorMessage($errorCode);
        }
      } else {
        // Kiểm tra lỗi khi không khớp hash
        $returnData['code'] = '97';
        $returnData['message'] = self::getErrorMessage('97');
      }
    } catch (\Exception $e) {
      // Xử lý lỗi trong trường hợp có exception
      $returnData['code'] = '99';
      $returnData['message'] = self::getErrorMessage('99');
    }

    $returnData['json'] = $inputData;
    return $returnData;
  }

  public static function getErrorMessage($errorCode) {
    self::init();
    switch ($errorCode) {
      case '00':
        return "Giao dịch thành công.";
      case '07':
        return "Giao dịch thành công, nhưng bị nghi ngờ (liên quan đến hành vi gian lận hoặc giao dịch bất thường).";
      case '09':
        return "Giao dịch không thành công: Khách hàng chưa đăng ký dịch vụ Internet Banking tại ngân hàng.";
      case '10':
        return "Giao dịch không thành công: Khách hàng đã nhập sai thông tin quá 3 lần.";
      case '11':
        return "Giao dịch không thành công: Đã hết hạn chờ thanh toán. Vui lòng thực hiện lại giao dịch.";
      case '12':
        return "Giao dịch không thành công: Thẻ/Tài khoản của khách hàng bị khóa.";
      case '13':
        return "Giao dịch không thành công: Mật khẩu xác thực giao dịch (OTP) không chính xác. Vui lòng thử lại.";
      case '24':
        return "Giao dịch không thành công: Khách hàng đã hủy giao dịch.";
      case '51':
        return "Giao dịch không thành công: Tài khoản của khách hàng không đủ số dư để thực hiện giao dịch.";
      case '65':
        return "Giao dịch không thành công: Tài khoản của khách hàng đã vượt quá hạn mức giao dịch trong ngày.";
      case '75':
        return "Giao dịch không thành công: Ngân hàng thanh toán đang bảo trì.";
      case '79':
        return "Giao dịch không thành công: Khách hàng nhập sai mật khẩu thanh toán quá số lần quy định. Vui lòng thử lại.";
      case '99':
        return "Giao dịch không thành công: Lỗi khác (lỗi không có trong danh sách mã lỗi đã liệt kê).";
      default:
        return "Lỗi không xác định.";
    }
  }
}
