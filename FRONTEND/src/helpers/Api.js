class Api {
    // 🔹 Loại bỏ dấu "/" dư thừa ở đầu và cuối
    static cleanEndpoint(endpoint = "") {
        return endpoint.trim().replace(/^\/+|\/+$/g, "");
    }

    // 🔹 Hàm chuẩn hóa endpoint với base
    static buildPath(base, endpoint = "") {
        const cleanBase = this.cleanEndpoint(base);
        const cleanEndpoint = this.cleanEndpoint(endpoint);
        return cleanEndpoint ? `${cleanBase}/${cleanEndpoint}` : cleanBase;
    }

    // 🔹 Các API route
    
    static login(endpoint = "") {
        return this.buildPath("login", endpoint);
    }

    static logout(endpoint = "") {
        return this.buildPath("logout", endpoint);
    }

    static register(endpoint = "") {
        return this.buildPath("register", endpoint);
    }

    static refreshToken(endpoint = "") {
        return this.buildPath("refresh-token", endpoint);
    }

    static categories(endpoint = "") {
        return this.buildPath("categories", endpoint);
    }

    static products(endpoint = "") {
        return this.buildPath("products", endpoint);
    }

    static carts(endpoint = "") {
        return this.buildPath("carts", endpoint);
    }
}

export default Api;
