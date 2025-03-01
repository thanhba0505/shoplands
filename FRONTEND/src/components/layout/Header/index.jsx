import {
    AppBar,
    Toolbar,
    Typography,
    Box,
    Button,
    IconButton,
    InputBase,
} from "@mui/material";
import {
    Search,
    ShoppingCart,
    Notifications,
    AccountCircle,
} from "@mui/icons-material";
import { useTheme } from "@mui/material/styles"; // 🟢 Dùng theme để lấy màu chủ đạo

const Header = () => {
    const theme = useTheme(); // 🟢 Lấy theme MUI

    return (
        <AppBar
            position="fixed"
            sx={{
                backgroundColor: "#fff", // 🔥 Nền trắng
                color: "#333",
                padding: "5px 0",
                boxShadow: "0px 4px 10px rgba(0,0,0,0.1)",
            }}
        >
            <Toolbar
                sx={{
                    display: "flex",
                    justifyContent: "space-between",
                    alignItems: "center",
                }}
            >
                {/* 🔹 Logo bên trái */}
                <Box sx={{ display: "flex", alignItems: "center" }}>
                    <Typography
                        variant="h6"
                        sx={{
                            fontWeight: "bold",
                            color: theme.palette.primary.main,
                        }} 
                    >
                        MyLogo
                    </Typography>
                </Box>

                {/* 🔹 Tabs Menu */}
                <Box sx={{ display: "flex", gap: 3 }}>
                    <Button>Trang chủ</Button>
                    <Button>Sản phẩm</Button>
                    <Button>Giới thiệu</Button>
                    <Button>Liên hệ</Button>
                </Box>

                {/* 🔹 Ô tìm kiếm */}
                <Box
                    sx={{
                        display: "flex",
                        alignItems: "center",
                        bgcolor: "#fff", // 🔥 Giữ nền trắng
                        border: `2px solid ${theme.palette.primary.light}`, // 🔥 Viền theo primary light
                        borderRadius: "20px",
                        padding: "5px 10px",
                        width: "300px",
                        transition: "border-color 0.3s ease-in-out",
                        "&:hover": { borderColor: theme.palette.primary.main }, // 🔥 Khi hover viền đậm hơn
                    }}
                >
                    <Search
                        sx={{
                            marginRight: "8px",
                            color: theme.palette.text.secondary,
                        }}
                    />
                    <InputBase
                        placeholder="Tìm kiếm..."
                        sx={{ flex: 1, color: theme.palette.text.secondary }}
                    />
                </Box>

                {/* 🔹 Icon Buttons */}
                <Box sx={{ display: "flex", gap: 1 }}>
                    <IconButton
                        sx={{
                            color: theme.palette.primary.light, // 🔥 Màu icon light
                            "&:hover": { color: theme.palette.primary.main }, // 🔥 Hover màu đậm hơn
                        }}
                    >
                        <Notifications />
                    </IconButton>
                    <IconButton
                        sx={{
                            color: theme.palette.primary.light,
                            "&:hover": { color: theme.palette.primary.main },
                        }}
                    >
                        <ShoppingCart />
                    </IconButton>
                    <IconButton
                        sx={{
                            color: theme.palette.primary.light,
                            "&:hover": { color: theme.palette.primary.main },
                        }}
                    >
                        <AccountCircle />
                    </IconButton>
                </Box>
            </Toolbar>
        </AppBar>
    );
};

export default Header;
