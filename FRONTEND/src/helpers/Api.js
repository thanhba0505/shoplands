class Api {
    static cleanEndpoint(endpoint = "") {
        return endpoint.trim().replace(/^\/|\/$/g, ""); // Loại bỏ "/" ở đầu & cuối
    }

    static auth(endpoint = "") {
        return `/auth/${this.cleanEndpoint(endpoint)}`;
    }

    static user(endpoint = "") {
        return `/user/${this.cleanEndpoint(endpoint)}`;
    }

    static product(endpoint = "") {
        return `/products/${this.cleanEndpoint(endpoint)}`;
    }

    static order(endpoint = "") {
        return `/orders/${this.cleanEndpoint(endpoint)}`;
    }
}

export default Api;
