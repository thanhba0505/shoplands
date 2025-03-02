// Layout
// import ContainerLayout from "~/components/Layout/ContainerLayout";
// import SidebarLeftLayout from "~/components/Layout/SidebarLeftLayout";
// import NoLayout from "~/components/Layout/NoLayout";

// Pages

// Auth
import Login from "~/pages/Auth/Login";

// Public
import Home from "~/pages/Public/Home";
import Product from "~/pages/Public/Product";
import Introduce from "~/pages/Public/Introduce";
import Contact from "~/pages/Public/Contact";

// User
import Cart from "~/pages/User/Cart";

// public routes
const publicRoutes = [
    { path: "/login", component: Login },
    { path: "/", component: Home },
    { path: "/products", component: Product },
    { path: "/introduce", component: Introduce },
    { path: "/contact", component: Contact },
];

const userRoutes = [{ path: "/cart", component: Cart }];

const sellerRoutes = [{ path: "/seller", component: Cart }];

const adminRoutes = [{ path: "/admin", component: Cart }];

export { publicRoutes, userRoutes, sellerRoutes, adminRoutes };
