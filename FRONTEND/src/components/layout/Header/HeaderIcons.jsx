import { useState } from "react";
import { Box, IconButton, Menu, MenuItem } from "@mui/material";
import {
    ShoppingCart,
    Notifications,
    AccountCircle,
} from "@mui/icons-material";
import { useTheme } from "@mui/material/styles";
import { useNavigate } from "react-router-dom";
import Path from "~/helpers/Path";

const HeaderIcons = () => {
    const theme = useTheme();
    const navigate = useNavigate();

    // State để quản lý menu đang mở
    const [menuAnchor, setMenuAnchor] = useState(null);
    const [activeMenu, setActiveMenu] = useState(null);

    // Mở menu
    const handleOpenMenu = (event, menuType) => {
        setMenuAnchor(event.currentTarget);
        setActiveMenu(menuType);
    };

    // Đóng menu
    const handleCloseMenu = () => {
        setMenuAnchor(null);
        setActiveMenu(null);
    };

    // Chuyển hướng
    const handleNavigate = (path) => {
        handleCloseMenu(); 
        navigate(path);
    };

    return (
        <Box sx={{ display: "flex", gap: 1 }}>
            {/* 🔹 Notifications Menu */}
            <IconButton
                onClick={(event) => handleOpenMenu(event, "notifications")}
                sx={{ color: theme.palette.primary.light }}
            >
                <Notifications />
            </IconButton>
            <Menu
                anchorEl={menuAnchor}
                open={activeMenu === "notifications"}
                onClose={handleCloseMenu}
                anchorOrigin={{ vertical: "bottom", horizontal: "right" }}
                transformOrigin={{ vertical: "top", horizontal: "right" }}
            >
                <MenuItem onClick={handleCloseMenu}>Thông báo 1</MenuItem>
                <MenuItem onClick={handleCloseMenu}>Thông báo 2</MenuItem>
                <MenuItem onClick={handleCloseMenu}>
                    Xem tất cả thông báo
                </MenuItem>
            </Menu>

            {/* 🔹 Shopping Cart Menu */}
            <IconButton
                onClick={(event) => handleOpenMenu(event, "cart")}
                sx={{ color: theme.palette.primary.light }}
            >
                <ShoppingCart />
            </IconButton>
            <Menu
                anchorEl={menuAnchor}
                open={activeMenu === "cart"}
                onClose={handleCloseMenu}
                anchorOrigin={{ vertical: "bottom", horizontal: "right" }}
                transformOrigin={{ vertical: "top", horizontal: "right" }}
            >
                <MenuItem onClick={handleCloseMenu}>Sản phẩm 1</MenuItem>
                <MenuItem onClick={handleCloseMenu}>Sản phẩm 2</MenuItem>
                <MenuItem onClick={handleCloseMenu}>Xem giỏ hàng</MenuItem>
            </Menu>

            {/* 🔹 User Account Menu */}
            <IconButton
                onClick={(event) => handleOpenMenu(event, "account")}
                sx={{ color: theme.palette.primary.light }}
            >
                <AccountCircle />
            </IconButton>
            <Menu
                anchorEl={menuAnchor}
                open={activeMenu === "account"}
                onClose={handleCloseMenu}
                anchorOrigin={{ vertical: "bottom", horizontal: "right" }}
                transformOrigin={{ vertical: "top", horizontal: "right" }}
            >
                <MenuItem onClick={() => handleNavigate(Path.userProfile())}>
                    Tài khoản của tôi
                </MenuItem>
                <MenuItem
                    onClick={() => handleNavigate(Path.userAddressBook())}
                >
                    Sổ địa chỉ
                </MenuItem>
                <MenuItem onClick={() => handleNavigate(Path.userOrders())}>
                    Lịch sử đơn hàng
                </MenuItem>
                <MenuItem onClick={handleCloseMenu}>Đăng xuất</MenuItem>
            </Menu>
        </Box>
    );
};

export default HeaderIcons;
