import { Avatar, Box, IconButton } from "@mui/material";
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

const ShoppingCartMenu = () => {
  const navigate = useNavigate();

  return (
    <IconButton
      onClick={() => navigate(Path.userCart())}
      sx={{ color: "#fff" }}
      size="medium"
    >
      <Avatar sx={{ bgcolor: "white", cursor: "pointer" }}>
        <ShoppingCart color="primary" sx={{ scale: 0.9 }} />
      </Avatar>
    </IconButton>
  );
};

const NotificationsMenu = () => {
  return (
    <MenuIcon
      icon={
        <Avatar sx={{ bgcolor: "white" }}>
          <Notifications color="primary" />
        </Avatar>
      }
      menuItems={[
        { label: "Thông báo 1" },
        { label: "Thông báo 2" },
        { label: "Xem tất cả thông báo" },
      ]}
    />
  );
};

const UserAccountMenu = () => {
  const user = Auth.getUser();
  const seller = Auth.getSeller();

  const navigate = useNavigate();
  const dispatch = useDispatch();
  const { enqueueSnackbar } = useSnackbar();

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

  // Menu item cho user, guest, và seller
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

  const guestMenuItems = [
    { label: "Đăng nhập", onClick: () => navigate(Path.login()) },
    { label: "Đăng ký", onClick: () => navigate(Path.register()) },
  ];

  const sellerMenuItems = [
    {
      label: "Quản lý cửa hàng",
      onClick: () => navigate(Path.sellerDashboard()),
    },
    { label: "Đăng xuất", onClick: handleLogout },
  ];

  // Xử lý avatar của người dùng và người bán
  const avatarSrc =
    (user?.avatar && Path.publicAvatar(user?.avatar)) ||
    (seller?.logo && Path.publicAvatar(seller?.logo));

  const avatarInitials =
    user?.name?.charAt(0) || seller?.store_name?.charAt(0) || "";

  // Dữ liệu menu để hiển thị
  const menuItems = user
    ? userMenuItems
    : seller
    ? sellerMenuItems
    : guestMenuItems;

  return (
    <MenuIcon
      icon={
        <Avatar
          src={avatarSrc} // Dùng ảnh đại diện nếu có
        >
          {avatarInitials ? avatarInitials : <AccountCircle fontSize="large" />}
        </Avatar>
      }
      menuItems={menuItems} // Chọn menu tùy thuộc vào người dùng
    />
  );
};

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
