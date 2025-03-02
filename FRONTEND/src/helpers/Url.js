class Url {
    static cleanPath(path = "") {
        return path.trim().replace(/^\/|\/$/g, ""); // Loại bỏ "/" ở đầu & cuối
    }

    static home(path = "") {
        return `/${this.cleanPath(path)}`;
    }

    static product(path = "") {
        return `/products/${this.cleanPath(path)}`;
    }

    static contact(path = "") {
        return `/contact/${this.cleanPath(path)}`;
    }

    static introduce(path = "") {
        return `/introduce/${this.cleanPath(path)}`;
    }

    // Kiểm tra path
    static getCurrentPath() {
        return window.location.pathname;
    }

    static isHome(path = "") {
        return this.getCurrentPath() === this.home(path);
    }

    static isProduct(path = "") {
        return this.getCurrentPath().startsWith(this.product(path));
    }

    static isContact(path = "") {
        return this.getCurrentPath().startsWith(this.contact(path));
    }

    static isIntroduce(path = "") {
        return this.getCurrentPath().startsWith(this.introduce(path));
    }
}

export default Url;
