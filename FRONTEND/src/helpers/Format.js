class Format {
  // Định dạng tiền tệ
  static formatCurrency(amount, currency = "VND", locale = "vi-VN") {
    const number = parseFloat(amount);

    if (number === 0) {
      return `0đ`;
    }

    if (isNaN(number)) {
      return ``;
    }
    // Định dạng tiền tệ với "đ" và không có khoảng cách
    return new Intl.NumberFormat(locale, {
      style: "currency",
      currency: currency,
    })
      .format(number)
      .replace("₫", "đ")
      .replace(/\s/g, "");
  }

  // Định dạng ngày giờ
  static formatDate(date, format = "DD/MM/YYYY", locale = "vi-VN") {
    const options = {
      weekday: "long",
      year: "numeric",
      month: "long",
      day: "numeric",
    };

    const dateObj = new Date(date);
    if (isNaN(dateObj)) {
      return "Ngày không hợp lệ";
    }

    if (format === "DD/MM/YYYY") {
      return new Intl.DateTimeFormat(locale, {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
      }).format(dateObj);
    }

    return new Intl.DateTimeFormat(locale, options).format(dateObj);
  }

  // Định dạng thời gian (HH:mm:ss)
  static formatTime(time) {
    const date = new Date(time);
    if (isNaN(date)) {
      return "Thời gian không hợp lệ";
    }
    return date.toLocaleTimeString();
  }

  // Định dạng ngày giờ (DateTime)
  static formatDateTime(
    date,
    format = "DD/MM/YYYY HH:mm:ss",
    locale = "vi-VN"
  ) {
    const dateObj = new Date(date);
    if (isNaN(dateObj)) {
      return "Ngày không hợp lệ";
    }

    // Nếu format là "DD/MM/YYYY HH:mm:ss"
    if (format === "DD/MM/YYYY HH:mm:ss") {
      return (
        new Intl.DateTimeFormat(locale, {
          day: "2-digit",
          month: "2-digit",
          year: "numeric",
        }).format(dateObj) +
        " " +
        dateObj.toLocaleTimeString(locale, {
          hour: "2-digit",
          minute: "2-digit",
          second: "2-digit",
        })
      );
    }

    // Nếu muốn định dạng khác cho ngày và giờ
    if (format === "MM/DD/YYYY HH:mm:ss") {
      return (
        new Intl.DateTimeFormat(locale, {
          month: "2-digit",
          day: "2-digit",
          year: "numeric",
        }).format(dateObj) +
        " " +
        dateObj.toLocaleTimeString(locale, {
          hour: "2-digit",
          minute: "2-digit",
          second: "2-digit",
        })
      );
    }

    return (
      new Intl.DateTimeFormat(locale, {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
      }).format(dateObj) +
      " " +
      dateObj.toLocaleTimeString(locale, {
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
      })
    );
  }

  // Định dạng số
  static formatNumber(number, locale = "vi-VN") {
    const num = parseFloat(number);
    if (isNaN(num)) {
      return "Số không hợp lệ";
    }
    return new Intl.NumberFormat(locale).format(num);
  }

  // Định dạng phần trăm
  static formatPercentage(number, decimals = 0, locale = "vi-VN") {
    const num = parseFloat(number);

    if (isNaN(num)) {
      return "Số không hợp lệ";
    }

    // Tính toán phần trăm với số thập phân tùy chọn
    const percentage = num * 100;

    return new Intl.NumberFormat(locale, {
      style: "percent",
      minimumFractionDigits: decimals,
      maximumFractionDigits: decimals, // Đảm bảo không quá số thập phân chỉ định
    }).format(percentage / 100); // Trả về dưới dạng phần trăm
  }

  // Định dạng ngày giờ kiểu '1 ngày trước', '3 giờ trước'
  static formatTimeAgo(date) {
    const now = new Date();
    const then = new Date(date);
    const diff = Math.abs(now - then);

    const seconds = Math.floor(diff / 1000);
    const minutes = Math.floor(diff / (1000 * 60));
    const hours = Math.floor(diff / (1000 * 60 * 60));
    const days = Math.floor(diff / (1000 * 60 * 60 * 24));

    if (days > 0) {
      return `${days} ngày trước`;
    } else if (hours > 0) {
      return `${hours} giờ trước`;
    } else if (minutes > 0) {
      return `${minutes} phút trước`;
    } else if (seconds > 0) {
      return `${seconds} giây trước`;
    }

    return "Vừa xong";
  }

  // Định dạng số lớn hơn 100 thành '1k', '1.3k'
  static formatLargeNumber(number) {
    const num = parseFloat(number);
    if (isNaN(num)) {
      return "Số không hợp lệ";
    }

    if (num >= 1000) {
      return (num / 1000).toFixed(1) + "k";
    }
    return num;
  }

  // Định dạng số với số chữ số thập phân cố định
  static formatNumberWithDecimals(number, decimals = 2, locale = "vi-VN") {
    const num = parseFloat(number);
    if (isNaN(num)) {
      return "Số không hợp lệ";
    }
    return num.toLocaleString(locale, {
      minimumFractionDigits: decimals,
      maximumFractionDigits: decimals,
    });
  }

  // Định dạng trạng thái đơn hàng
  static formatOrderStatus(status) {
    switch (status) {
      case "unpaid":
        return "Chưa thanh toán";
      case "packing":
        return "Đang đóng gói";
      case "packed":
        return "Đã đóng gói";
      case "cancelled":
        return "Dang xu ly";
      case "shipping":
        return "Đang giao hàng";
      case "delivered":
        return "Đã giao hàng";
      case "completed":
        return "Hoàn thành";
      case "return-request":
        return "Yêu cầu trả hàng";
      case "return-rejected":
        return "Từ chối trả hàng";
      case "return-accepted":
        return "Đồng ý trả hàng";
      case "returned":
        return "Đã trả hàng";
      default:
        return "Lỗi trạng thái";
    }
  }
}

export default Format;
