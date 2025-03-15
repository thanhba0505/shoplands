class Log {
  static info(data, title = "info") {
    title = title.toUpperCase();
    const color = "color: #00bfff"; // Màu xanh lam cho info
    if (typeof data === "object") {
      console.log(`%c${title}`, color, data); // Log đối tượng hoặc mảng trực tiếp
    } else {
      console.log(`%c${title}: ${data}`, color); // Log chuỗi
    }
  }

  static error(data, title = "error") {
    title = title.toUpperCase();
    const color = "color: #ff6347"; // Màu đỏ cho lỗi
    if (typeof data === "object") {
      console.error(`%c${title}`, color, data); // Log đối tượng/mảng trong lỗi
    } else {
      console.error(`%c${title}: ${data}`, color); // Log chuỗi
    }
  }

  static debug(data, title = "debug") {
    title = title.toUpperCase();
    const color = "color: #32cd32"; // Màu xanh lá cho debug
    if (typeof data === "object") {
      console.debug(`%c${title}`, color, data); // Log đối tượng/mảng trong debug
    } else {
      console.debug(`%c${title}: ${data}`, color); // Log chuỗi
    }
  }

  static warn(data, title = "warn") {
    title = title.toUpperCase();
    const color = "color: #ffa500"; // Màu cam cho cảnh báo
    if (typeof data === "object") {
      console.warn(`%c${title}`, color, data); // Log đối tượng/mảng trong cảnh báo
    } else {
      console.warn(`%c${title}: ${data}`, color); // Log chuỗi
    }
  }
}

export default Log;
