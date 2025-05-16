class Api {
  // 🔹 Loại bỏ dấu "/" dư thừa ở đầu và cuối
  static cleanEndpoint(endpoint = "") {
    return endpoint.trim().replace(/^\/+|\/+$/g, "");
  }

  // 🔹 Hàm chuẩn hóa endpoint với base
  static buildPath(base, endpoint = "") {
    endpoint = endpoint.toString();
    const cleanBase = this.cleanEndpoint(base);
    const cleanEndpoint = this.cleanEndpoint(endpoint);
    return cleanEndpoint ? `${cleanBase}/${cleanEndpoint}` : cleanBase;
  }

  // 🔹 Các API route

  static login(endpoint = "") {
    return this.buildPath("auth/login", endpoint);
  }

  static codeLogin(endpoint = "") {
    return this.buildPath("auth/code-login", endpoint);
  }

  static logout(endpoint = "") {
    return this.buildPath("auth/logout", endpoint);
  }

  static register(endpoint = "") {
    return this.buildPath("auth/register", endpoint);
  }

  static codeRegister(endpoint = "") {
    return this.buildPath("auth/code-register", endpoint);
  }

  static forgotPassword(endpoint = "") {
    return this.buildPath("auth/forgot-password", endpoint);
  }

  static codeForgotPassword(endpoint = "") {
    return this.buildPath("auth/code-forgot-password", endpoint);
  }

  static refreshToken(endpoint = "") {
    return this.buildPath("auth/refresh-token", endpoint);
  }

  static provinces(endpoint = "") {
    return this.buildPath("address/provinces", endpoint);
  }

  static districts(endpoint = "") {
    return this.buildPath("address/districts", endpoint);
  }

  static wards(endpoint = "") {
    return this.buildPath("address/wards", endpoint);
  }

  static categories(endpoint = "") {
    return this.buildPath("categories", endpoint);
  }

  static products(endpoint = "") {
    return this.buildPath("products", endpoint);
  }

  static cart(endpoint = "") {
    return this.buildPath("user/cart", endpoint);
  }

  static address(endpoint = "") {
    return this.buildPath("user/address", endpoint);
  }

  static orders(endpoint = "") {
    return this.buildPath("user/orders", endpoint);
  }

  static coupons(endpoint = "") {
    return this.buildPath("coupons", endpoint);
  }

  static shippingFee(endpoint = "") {
    return this.buildPath("user/orders/shipping-fee", endpoint);
  }

  static sellers(endpoint = "") {
    return this.buildPath("sellers", endpoint);
  }

  static banks(endpoint = "") {
    return this.buildPath("banks", endpoint);
  }

  static reviews(endpoint = "") {
    return this.buildPath("reviews", endpoint);
  }

  // User

  static user(endpoint = "") {
    return this.buildPath("user", endpoint);
  }

  static userAddress(endpoint = "") {
    return this.buildPath("user/address", endpoint);
  }

  static userReviews(endpoint = "") {
    return this.buildPath("user/reviews", endpoint);
  }

  // Seller
  static sellerOrders(endpoint = "") {
    return this.buildPath("seller/orders", endpoint);
  }

  static sellerProducts(endpoint = "") {
    return this.buildPath("seller/products", endpoint);
  }

  static sellerCoupons(endpoint = "") {
    return this.buildPath("seller/coupons", endpoint);
  }

  // Admin
  static adminSellers(endpoint = "") {
    return this.buildPath("admin/sellers", endpoint);
  }

  static adminUsers(endpoint = "") {
    return this.buildPath("admin/users", endpoint);
  }
}

export default Api;
