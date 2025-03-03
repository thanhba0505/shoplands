class Path {
    static home(subPath = "") {
        return this.buildPath("/", subPath);
    }

    static login(subPath = "") {
        return this.buildPath("/login", subPath);
    }

    static register(subPath = "") {
        return this.buildPath("/register", subPath);
    }

    static products(subPath = "") {
        return this.buildPath("/products", subPath);
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

    // SELLER PATHS
    static sellerDashboard(subPath = "") {
        return this.buildPath("/seller/dashboard", subPath);
    }

    static sellerOrders(subPath = "") {
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
        return subPath
            ? `${basePath}/${subPath.replace(/^\/+/, "")}`
            : basePath;
    }
}

export default Path;
