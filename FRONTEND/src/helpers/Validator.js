class Validator {
  // Kiểm tra số điện thoại (với định dạng VN, cho phép +84 hoặc 0)
  static isPhone(phone) {
    const phoneRegex = /^(?:\+84|0)(3|5|7|8|9)\d{8}$/; // Cho phép số điện thoại VN với +84 hoặc 0 ở đầu
    return phoneRegex.test(phone);
  }

  // Kiểm tra độ mạnh của mật khẩu
  static isPasswordStrength(password) {
    const minLength = 8;
    const hasUpperCase = /[A-Z]/.test(password); // Kiểm tra có chữ hoa
    const hasLowerCase = /[a-z]/.test(password); // Kiểm tra có chữ thường
    const hasNumbers = /\d/.test(password); // Kiểm tra có số
    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password); // Kiểm tra có ký tự đặc biệt

    if (password.length < minLength) {
      return "Mật khẩu phải có ít nhất 8 ký tự.";
    }

    if (!hasUpperCase) {
      return "Mật khẩu phải chứa ít nhất một chữ hoa.";
    }

    if (!hasLowerCase) {
      return "Mật khẩu phải chứa ít nhất một chữ thường.";
    }

    if (!hasNumbers) {
      return "Mật khẩu phải chứa ít nhất một chữ số.";
    }

    if (!hasSpecialChar) {
      return "Mật khẩu phải chứa ít nhất một ký tự đặc biệt.";
    }

    return "Mật khẩu hợp lệ";
  }
}

export default Validator;
