import store from "~/redux/store";

class Auth {
  static check(role) {
    const { account } = store.getState().auth;
    return account?.role === role;
  }

  static checkSeller() {
    return this.check("seller");
  }

  static checkAdmin() {
    return this.check("admin");
  }

  static checkUser() {
    return this.check("user");
  }

  static getSeller() {
    const { account } = store.getState().auth;
    return account?.role === "seller" ? account : null;
  }

  static getUser() {
    const { account } = store.getState().auth;
    return account?.role === "user" ? account : null;
  }

  static getAdmin() {
    const { account } = store.getState().auth;
    return account?.role === "admin" ? account : null;
  }
}

export default Auth;
