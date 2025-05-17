// Layout
import SellerLayout from "~/components/layout/SellerLayout";
import UserLayout from "~/components/layout/UserLayout";
import AdminLayout from "~/components/layout/AdminLayout";
import IntroduceLayout from "~/components/layout/IntroduceLayout";

// Auth
import Login from "~/pages/Auth/Login";
import Register from "~/pages/Auth/Register";
import ForgotPassword from "~/pages/Auth/ForgotPassword";
import ResetPassword from "~/pages/Auth/ResetPassword";
import RegisterSeller from "~/pages/Auth/RegisterSeller";

// Public
import Home from "~/pages/Public/Home";
import Products from "~/pages/Public/Products";
import Introduce from "~/pages/Public/Introduce";
import Contact from "~/pages/Public/Contact";
import ProductDetail from "~/pages/Public/ProductDetail";
import Seller from "~/pages/Public/Seller";

// User
import Cart from "~/pages/User/Cart";
import Profile from "~/pages/User/Profile";
import AddressBook from "~/pages/User/AddressBook";
import Orders from "~/pages/User/Orders";
import OrderDetail from "~/pages/User/OrderDetail";
import Checkout from "~/pages/User/Checkout";

// Seller
import Dashboard from "~/pages/Seller/Dashboard";
import OrdersSeller from "~/pages/Seller/Orders";
import ProductSellers from "~/pages/Seller/Products";
import Promotions from "~/pages/Seller/Promotions";
import Settings from "~/pages/Seller/Settings";
import SellerProductDetail from "~/pages/Seller/Products/ProductDetail";

// Admin
import DashboardAdmin from "~/pages/Admin/Dashboard";
import Users from "~/pages/Admin/Users";
import Sellers from "~/pages/Admin/Sellers";
import ProductsAdmin from "~/pages/Admin/Products";

//-------------------------------------------------------------//
// PUBLIC ROUTES
const publicRoutes = [
  // Auth
  { path: "/login", component: Login },
  { path: "/register", component: Register },
  { path: "/register-seller", component: RegisterSeller },
  { path: "/forgot-password", component: ForgotPassword },
  { path: "/reset-password", component: ResetPassword },
  // Public
  { path: "/", component: Home },
  { path: "/products", component: Products },
  { path: "/product-detail/:id", component: ProductDetail },
  { path: "/introduce/:page", component: Introduce, layout: IntroduceLayout },
  { path: "/contact", component: Contact },
  { path: "/shop/:sellerId", component: Seller },
];

// USER ROUTES
const userRoutes = [
  { path: "/user/cart", component: Cart },
  { path: "/user/profile", component: Profile, layout: UserLayout },
  {
    path: "/user/address-book",
    component: AddressBook,
    layout: UserLayout,
  },
  { path: "/user/orders/detail/:orderId", component: OrderDetail },
  { path: "/user/orders/checkout", component: Checkout },
  { path: "/user/orders/:status", component: Orders, layout: UserLayout },
];

// SELLER ROUTES
const sellerRoutes = [
  { path: "/seller/dashboard", component: Dashboard, layout: SellerLayout },
  // Đơn hàng
  // { path: "/seller/orders", component: OrdersSeller, layout: SellerLayout },
  // { path: "/seller/orders/detail/:orderId", component: OrdersSeller, layout: SellerLayout },
  {
    path: "/seller/orders/:status",
    component: OrdersSeller,
    layout: SellerLayout,
  },

  // Sản phẩm
  {
    path: "/seller/products/:page",
    component: ProductSellers,
    layout: SellerLayout,
  },
  {
    path: "/seller/products/detail/:productId",
    component: SellerProductDetail,
    layout: SellerLayout,
  },

  // Khuyến mãi
  {
    path: "/seller/promotions/:page",
    component: Promotions,
    layout: SellerLayout,
  },

  // Cài đặt
  { path: "/seller/settings", component: Settings, layout: SellerLayout },
];

// ADMIN ROUTES
const adminRoutes = [
  { path: "/admin/dashboard", component: DashboardAdmin, layout: AdminLayout },
  { path: "/admin/sellers/:pageName", component: Sellers, layout: AdminLayout },
  { path: "/admin/users/:pageName", component: Users, layout: AdminLayout },
  {
    path: "/admin/products/:pageName",
    component: ProductsAdmin,
    layout: AdminLayout,
  },
];

export { publicRoutes, userRoutes, sellerRoutes, adminRoutes };
