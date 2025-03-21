// Layout
import ManageLayout from "~/components/layout/ManageLayout";

// Auth
import Login from "~/pages/Auth/Login";
import Register from "~/pages/Auth/Register";
import ForgotPassword from "~/pages/Auth/ForgotPassword";

// Public
import Home from "~/pages/Public/Home";
import Products from "~/pages/Public/Products";
import Introduce from "~/pages/Public/Introduce";
import Contact from "~/pages/Public/Contact";
import ProductDetail from "~/pages/Public/ProductDetail";

// User
import Cart from "~/pages/User/Cart";
import Profile from "~/pages/User/Profile";
import AddressBook from "~/pages/User/AddressBook";
import Orders from "~/pages/User/Orders";
import OrderDetail from "~/pages/User/OrderDetail";
import Checkout from "~/pages/User/Checkout";
import Payment from "~/pages/User/Payment";

// Seller
import Dashboard from "~/pages/Seller/Dashboard";
import OrdersSeller from "~/pages/Seller/Orders";
import ProductSellers from "~/pages/Seller/Products";
import Promotions from "~/pages/Seller/Promotions";
import Settings from "~/pages/Seller/Settings";

// Admin
import DashboardAdmin from "~/pages/Admin/Dashboard";
import Users from "~/pages/Admin/Users";
import Sellers from "~/pages/Admin/Sellers";

//-------------------------------------------------------------//
// PUBLIC ROUTES
const publicRoutes = [
  // Auth
  { path: "/login", component: Login },
  { path: "/register", component: Register },
  { path: "/forgot-password", component: ForgotPassword },
  // Public
  { path: "/", component: Home },
  { path: "/products", component: Products },
  { path: "/product-detail/:id", component: ProductDetail },
  { path: "/introduce", component: Introduce },
  { path: "/contact", component: Contact },
];

// USER ROUTES
const userRoutes = [
  { path: "/user/cart", component: Cart },
  { path: "/user/profile", component: Profile },
  { path: "/user/address-book", component: AddressBook },
  { path: "/user/orders", component: Orders },
  { path: "/user/orders/detail/:id", component: OrderDetail },
  { path: "/user/orders/checkout", component: Checkout },
  { path: "/user/orders/payment", component: Payment },
];

// SELLER ROUTES
const sellerRoutes = [
  { path: "/seller/dashboard", component: Dashboard, layout: ManageLayout },
  // Đơn hàng
  { path: "/seller/orders", component: OrdersSeller, layout: ManageLayout },
  { path: "/seller/orders/all", component: OrdersSeller, layout: ManageLayout },
  { path: "/seller/orders/packing", component: OrdersSeller, layout: ManageLayout },
  { path: "/seller/orders/packed", component: OrdersSeller, layout: ManageLayout },
  { path: "/seller/orders/shipping", component: OrdersSeller, layout: ManageLayout },
  { path: "/seller/orders/delivered", component: OrdersSeller, layout: ManageLayout },
  { path: "/seller/orders/completed", component: OrdersSeller, layout: ManageLayout },

  // Sản phẩm
  { path: "/seller/products", component: ProductSellers, layout: ManageLayout },
  { path: "/seller/products/all", component: ProductSellers, layout: ManageLayout },
  { path: "/seller/products/active", component: ProductSellers, layout: ManageLayout },
  { path: "/seller/products/locked", component: ProductSellers, layout: ManageLayout },
  { path: "/seller/products/new", component: ProductSellers, layout: ManageLayout },
  { path: "/seller/products/inventory", component: ProductSellers, layout: ManageLayout },
  { path: "/seller/products/import-products", component: ProductSellers, layout: ManageLayout },
  { path: "/seller/products/reviews", component: ProductSellers, layout: ManageLayout },

  // Khuyến mãi
  { path: "/seller/promotions", component: Promotions, layout: ManageLayout },
  { path: "/seller/promotions/product-discount", component: Promotions, layout: ManageLayout },
  { path: "/seller/promotions/coupon", component: Promotions, layout: ManageLayout },

  // Cài đặt
  { path: "/seller/settings", component: Settings, layout: ManageLayout },
  { path: "/seller/settings/shop", component: Settings, layout: ManageLayout },
  { path: "/seller/settings/payment", component: Settings, layout: ManageLayout },
];

// ADMIN ROUTES
const adminRoutes = [
  { path: "/admin/dashboard", component: DashboardAdmin },
  { path: "/admin/users", component: Users },
  { path: "/admin/sellers", component: Sellers },
];

export { publicRoutes, userRoutes, sellerRoutes, adminRoutes };
