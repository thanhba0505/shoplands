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

  // Cộng thời gian vào ngày (Ngày, Giờ, Phút, Giây)
  static addTime(date, days = 0, hours = 0, minutes = 0, seconds = 0) {
    const dateObj = new Date(date);

    if (isNaN(dateObj)) {
      return "Ngày không hợp lệ";
    }

    dateObj.setDate(dateObj.getDate() + days); // Cộng ngày
    dateObj.setHours(dateObj.getHours() + hours); // Cộng giờ
    dateObj.setMinutes(dateObj.getMinutes() + minutes); // Cộng phút
    dateObj.setSeconds(dateObj.getSeconds() + seconds); // Cộng giây

    return dateObj;
  }

  // Trừ thời gian từ ngày (Ngày, Giờ, Phút, Giây)
  static subtractTime(date, days = 0, hours = 0, minutes = 0, seconds = 0) {
    const dateObj = new Date(date);

    if (isNaN(dateObj)) {
      return "Ngày không hợp lệ";
    }

    dateObj.setDate(dateObj.getDate() - days); // Trừ ngày
    dateObj.setHours(dateObj.getHours() - hours); // Trừ giờ
    dateObj.setMinutes(dateObj.getMinutes() - minutes); // Trừ phút
    dateObj.setSeconds(dateObj.getSeconds() - seconds); // Trừ giây

    return dateObj;
  }

  // Hàm tính số ngày từ hiện tại đến date1 và từ hiện tại đến date2, sau đó trả về "X đến Y ngày"
  static calculateEstimatedTime(date1, date2) {
    const currentDate = new Date(); // Lấy thời gian hiện tại

    const startDate = new Date(date1); // Convert date1 thành Date
    const endDate = new Date(date2); // Convert date2 thành Date

    if (isNaN(startDate) || isNaN(endDate)) {
      return "Ngày không hợp lệ";
    }

    // Cộng thêm 1 ngày vào cả hai ngày
    startDate.setDate(startDate.getDate() + 1);
    endDate.setDate(endDate.getDate() + 1);

    // Tính số ngày từ hiện tại đến date1
    const diff1 = Math.abs(currentDate - startDate); // Lấy sự khác biệt về thời gian
    const daysToDate1 = Math.floor(diff1 / (1000 * 3600 * 24)); // Chuyển đổi từ milliseconds sang ngày

    // Tính số ngày từ hiện tại đến date2
    const diff2 = Math.abs(currentDate - endDate); // Lấy sự khác biệt về thời gian
    const daysToDate2 = Math.floor(diff2 / (1000 * 3600 * 24)); // Chuyển đổi từ milliseconds sang ngày

    // Nếu hai ngày giống nhau, chỉ cần trả về số ngày từ hiện tại đến date1 hoặc date2
    if (daysToDate1 === daysToDate2) {
      return `${daysToDate1} ngày`;
    }

    // Trả về kết quả theo định dạng "X đến Y ngày"
    return `${daysToDate1} đến ${daysToDate2} ngày`;
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
  static formatStatus(status) {
    switch (status) {
      case "active":
        return "Đang hoạt động";
      case "inactive":
        return "Chưa hoạt động";
      case "locked":
        return "Đã bị khóa";
      case "deleted":
        return "Đã bị xóa";
      case "unverified":
        return "Chưa xác thực";
      default:
        return "Lỗi trạng thái";
    }
  }
}

export default Format;
