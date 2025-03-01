// Layout
// import ContainerLayout from "~/components/Layout/ContainerLayout";
// import SidebarLeftLayout from "~/components/Layout/SidebarLeftLayout";
// import NoLayout from "~/components/Layout/NoLayout";

// Pages

// Public
import Home from "~/pages/Public/Home";
import Login from "~/pages/Auth/Login";

// User
import Cart from "~/pages/User/Cart";

// public routes
const publicRoutes = [
    { path: "/", component: Home },
    { path: "/login", component: Login },
];

const userRoutes = [{ path: "/cart", component: Cart }];

const sellerRoutes = [{ path: "/seller", component: Cart }];

const adminRoutes = [{ path: "/admin", component: Cart }];

export { publicRoutes, userRoutes, sellerRoutes, adminRoutes };
