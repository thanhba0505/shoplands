import store from "~/redux/store";

class Auth {
    /**
     * Kiểm tra vai trò của người dùng
     * @param {string} role - Vai trò cần kiểm tra (e.g., 'seller', 'user')
     * @returns {boolean}
     */
    static check(role) {
        const { account } = store.getState().auth;
        return account?.role === role;
    }

    /**
     * Kiểm tra người dùng có phải Seller không
     * @returns {boolean}
     */
    static checkSeller() {
        return this.check("seller");
    }

    /**
     * Kiểm tra người dùng có phải Seller không
     * @returns {boolean}
     */
    static checkAdmin() {
        return this.check("admin");
    }

    /**
     * Kiểm tra người dùng có phải User không
     * @returns {boolean}
     */
    static checkUser() {
        return this.check("user");
    }

    /**
     * Lấy thông tin Seller
     * @returns {object|null}
     */
    static getSeller() {
        const { account } = store.getState().auth;
        return account?.role === "seller" ? account : null;
    }

    /**
     * Lấy thông tin User
     * @returns {object|null}
     */
    static getUser() {
        const { account } = store.getState().auth;
        return account?.role === "user" ? account : null;
    }
}

export default Auth;
