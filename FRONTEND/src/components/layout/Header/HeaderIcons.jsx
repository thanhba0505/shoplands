import { Box, IconButton } from "@mui/material";
import {
  ShoppingCart,
  Notifications,
  AccountCircle,
} from "@mui/icons-material";
import { useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { logout } from "~/redux/authSlice";
import Path from "~/helpers/Path";
import { startLoading, stopLoading } from "~/redux/loadingSlice";
import axiosWithAuth from "~/utils/axiosWithAuth";
import Api from "~/helpers/Api";
import { useSnackbar } from "notistack";
import Auth from "~/helpers/Auth";
import MenuIcon from "~/components/MenuIcon";

// 🔹 Shopping Cart Menu
const ShoppingCartMenu = () => {
  const navigate = useNavigate();
  return (
    <IconButton
      size="medium"
      onClick={() => navigate(Path.userCart())}
      sx={{ color: "primary.light" }}
    >
      <ShoppingCart />
    </IconButton>
  );
};

// 🔹 Notifications Menu
const NotificationsMenu = () => {
  return (
    <MenuIcon
      icon={<Notifications />}
      menuItems={[
        { label: "Thông báo 1" },
        { label: "Thông báo 2" },
        { label: "Xem tất cả thông báo" },
      ]}
    />
  );
};

// 🔹 User Account Menu
const UserAccountMenu = () => {
  const isUser = Auth.checkUser(); // 🔥 Kiểm tra user đăng nhập

  const navigate = useNavigate();
  const dispatch = useDispatch();
  const { enqueueSnackbar } = useSnackbar();

  // 🔥 Hàm xử lý logout
  const handleLogout = async () => {
    dispatch(startLoading());

    try {
      const response = await axiosWithAuth.post(Api.logout(), {});
      dispatch(logout());
      enqueueSnackbar(response.data.message, { variant: "success" });
      navigate(Path.login());
    } catch (error) {
      navigate(Path.login());
      console.error("Đăng xuất thất bại: " + error.response?.data?.message);
    } finally {
      dispatch(stopLoading());
    }
  };

  // 🔹 Nếu có user, hiển thị menu tài khoản
  const userMenuItems = [
    {
      label: "Tài khoản của tôi",
      onClick: () => navigate(Path.userProfile()),
    },
    {
      label: "Sổ địa chỉ",
      onClick: () => navigate(Path.userAddressBook()),
    },
    {
      label: "Lịch sử đơn hàng",
      onClick: () => navigate(Path.userOrders("all")),
    },
    { label: "Đăng xuất", onClick: handleLogout },
  ];

  // 🔹 Nếu chưa đăng nhập, chỉ hiển thị đăng nhập & đăng ký
  const guestMenuItems = [
    { label: "Đăng nhập", onClick: () => navigate(Path.login()) },
    { label: "Đăng ký", onClick: () => navigate(Path.register()) },
  ];

  return (
    <MenuIcon
      icon={<AccountCircle />}
      menuItems={isUser ? userMenuItems : guestMenuItems}
    />
  );
};

// 🔹 HeaderIcons (Tổng hợp)
const HeaderIcons = () => {
  return (
    <Box sx={{ display: "flex", alignItems: "center", gap: 1 }}>
      {Auth.checkUser() && (
        <>
          <ShoppingCartMenu />
          <NotificationsMenu />
        </>
      )}
      <UserAccountMenu />
    </Box>
  );
};

export default HeaderIcons;
