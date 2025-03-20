class Path {
  // Kiểm tra path bắt đầu bằng
  static checkStartsWith(basePath, targetPath) {
    const formattedBasePath = basePath.replace(/^\/+|\/+$/g, "") + "/";
    const formattedTargetPath = targetPath.replace(/^\/+|\/+$/g, "") + "/";

    return formattedTargetPath.startsWith(formattedBasePath);
  }

  // Lấy phần tử path thứ index
  static getElement(path, index) {
    const pathSegments = path.split("/");
    return pathSegments.length > index ? pathSegments[index] : null;
  }

  // Lấy path từ vị trí thứ index
  static getPathFromIndex(path, index) {
    const pathSegments = path.split("/");
    if (pathSegments.length > index) {
      return "/" + pathSegments.slice(index).join("/");
    }
    return null; 
  }

  // ASSET PATHS
  static public(subPath = "") {
    return this.buildPath(import.meta.env.VITE_API_URL_PUBLIC, subPath);
  }

  static publicApp(subPath = "") {
    return this.buildPath(this.public() + "/app", subPath);
  }

  static publicAvatar(subPath = "") {
    return this.buildPath(this.public() + "/uploaded/avatar", subPath);
  }

  static publicBackground(subPath = "") {
    return this.buildPath(this.public() + "/uploaded/background", subPath);
  }

  static publicProduct(subPath = "") {
    return this.buildPath(this.public() + "/uploaded/product", subPath);
  }

  // PUBLIC PATHS
  static home(subPath = "") {
    return this.buildPath("/", subPath);
  }

  static login(subPath = "") {
    return this.buildPath("/login", subPath);
  }

  static register(subPath = "") {
    return this.buildPath("/register", subPath);
  }

  static forgotPassword(subPath = "") {
    return this.buildPath("/forgot-password", subPath);
  }

  static products(subPath = "") {
    return this.buildPath("/products", subPath);
  }

  static productDetail(subPath = "") {
    return this.buildPath("/product-detail", subPath);
  }

  static introduce(subPath = "") {
    return this.buildPath("/introduce", subPath);
  }

  static contact(subPath = "") {
    return this.buildPath("/contact", subPath);
  }

  // USER PATHS
  static userProfile(subPath = "") {
    return this.buildPath("/user/profile", subPath);
  }

  static userCart(subPath = "") {
    return this.buildPath("/user/cart", subPath);
  }

  static userOrders(subPath = "") {
    return this.buildPath("/user/orders", subPath);
  }

  static userAddressBook(subPath = "") {
    return this.buildPath("/user/address-book", subPath);
  }

  static userCheckout(subPath = "") {
    return this.buildPath("/user/orders/checkout", subPath);
  }

  static userPayment(subPath = "") {
    return this.buildPath("/user/orders/payment", subPath);
  }

  // SELLER PATHS
  static seller(subPath = "") {
    return this.buildPath("/seller", subPath);
  }

  static sellerDashboard(subPath = "") {
    return this.buildPath("/seller/dashboard", subPath);
  }

  static sellerOrders(subPath = "all") {
    return this.buildPath("/seller/orders", subPath);
  }

  static sellerProducts(subPath = "") {
    return this.buildPath("/seller/products", subPath);
  }

  // ADMIN PATHS
  static adminDashboard(subPath = "") {
    return this.buildPath("/admin/dashboard", subPath);
  }

  static adminUsers(subPath = "") {
    return this.buildPath("/admin/users", subPath);
  }

  static adminSellers(subPath = "") {
    return this.buildPath("/admin/sellers", subPath);
  }

  // Helper function to format the path correctly
  static buildPath(basePath, subPath) {
    const subPathString = String(subPath); // Chuyển subPath thành string
    return subPathString
      ? `${basePath}/${subPathString.replace(/^\/+/, "")}`
      : basePath;
  }
}

export default Path;
