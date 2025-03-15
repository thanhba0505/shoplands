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
    
    static logout(endpoint = "") {
        return this.buildPath("auth/logout", endpoint);
    }

    static register(endpoint = "") {
        return this.buildPath("auth/register", endpoint);
    }

    static forgotPassword(endpoint = "") {
        return this.buildPath("auth/forgot-password", endpoint);
    }

    static refreshToken(endpoint = "") {
        return this.buildPath("auth/refresh-token", endpoint);
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

    static coupons(endpoint = "") {
        return this.buildPath("coupons", endpoint);
    }
}

export default Api;
