import { useState } from "react";
import { Box, IconButton, Menu, MenuItem } from "@mui/material";
import {
    ShoppingCart,
    Notifications,
    AccountCircle,
} from "@mui/icons-material";
import { useTheme } from "@mui/material/styles";
import { useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { logout } from "~/redux/authSlice";
import Path from "~/helpers/Path";
import { startLoading, stopLoading } from "~/redux/loadingSlice";
import axiosWithAuth from "~/utils/axiosWithAuth";
import Api from "~/helpers/Api";
import { useSnackbar } from "notistack";
import Auth from "~/helpers/Auth";

// 🔹 Component Menu Icon chung
const MenuIcon = ({ icon, menuItems }) => {
    const theme = useTheme();
    const [menuAnchor, setMenuAnchor] = useState(null);

    const handleOpenMenu = (event) => {
        setMenuAnchor(event.currentTarget);
    };

    const handleCloseMenu = () => {
        setMenuAnchor(null);
    };

    return (
        <>
            <IconButton
                onClick={handleOpenMenu}
                sx={{ color: theme.palette.primary.light }}
            >
                {icon}
            </IconButton>
            <Menu
                anchorEl={menuAnchor}
                open={Boolean(menuAnchor)}
                onClose={handleCloseMenu}
                anchorOrigin={{ vertical: "bottom", horizontal: "right" }}
                transformOrigin={{ vertical: "top", horizontal: "right" }}
            >
                {menuItems.map((item, index) => (
                    <MenuItem
                        key={index}
                        sx={{ minWidth: "150px" }}
                        onClick={(event) => {
                            handleCloseMenu();
                            if (item.onClick) {
                                item.onClick(event);
                            }
                        }}
                    >
                        {item.label}
                    </MenuItem>
                ))}
            </Menu>
        </>
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

// 🔹 Shopping Cart Menu
const ShoppingCartMenu = () => {
    return (
        <MenuIcon
            icon={<ShoppingCart />}
            menuItems={[
                { label: "Sản phẩm 1" },
                { label: "Sản phẩm 2" },
                { label: "Xem giỏ hàng" },
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
            const response = await axiosWithAuth.post(Api.auth("logout"), {});
            dispatch(logout());
            enqueueSnackbar(response.data.message, { variant: "success" });
            navigate(Path.login());
        } catch (error) {
            dispatch(logout());
            navigate(Path.login());
            console.error(
                "Đăng xuất thất bại: " + error.response?.data?.message
            );
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
            onClick: () => navigate(Path.userOrders()),
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
        <Box sx={{ display: "flex", gap: 1 }}>
            <NotificationsMenu />
            <ShoppingCartMenu />
            <UserAccountMenu />
        </Box>
    );
};

export default HeaderIcons;
