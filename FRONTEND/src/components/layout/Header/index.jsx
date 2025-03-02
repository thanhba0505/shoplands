import {
    AppBar,
    Toolbar,
    Typography,
    Box,
    IconButton,
    InputBase,
    Container,
} from "@mui/material";
import {
    Search,
    ShoppingCart,
    Notifications,
    AccountCircle,
} from "@mui/icons-material";
import { useTheme } from "@mui/material/styles";
import Url from "~/helpers/Url";
import ButtonNavigate from "~/components/ButtonNavigate";

const Header = () => {
    const theme = useTheme();

    return (
        <AppBar
            position="sticky"
            sx={{
                height: theme.custom?.headerHeight || "74px",
                backgroundColor: "#fff", // 🔥 Nền trắng
                color: "#333",
                padding: "5px 0",
                boxShadow: "0px 4px 10px rgba(0,0,0,0.1)",
            }}
        >
            <Container maxWidth="xl">
                {" "}
                {/* 🔥 Giới hạn nội dung bên trong */}
                <Toolbar
                    sx={{
                        display: "flex",
                        justifyContent: "space-between",
                        alignItems: "center",
                        padding: "0px !important",
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
                    <Box sx={{ display: "flex", gap: 1 }}>
                        <ButtonNavigate to={Url.home()} sx={{ width: "120px" }}>
                            Trang chủ
                        </ButtonNavigate>
                        <ButtonNavigate
                            to={Url.product()}
                            sx={{ width: "120px" }}
                        >
                            Sản phẩm
                        </ButtonNavigate>
                        <ButtonNavigate
                            to={Url.introduce()}
                            sx={{ width: "120px" }}
                        >
                            Giới thiệu
                        </ButtonNavigate>
                        <ButtonNavigate
                            to={Url.contact()}
                            sx={{ width: "120px" }}
                        >
                            Liên hệ
                        </ButtonNavigate>
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
                            "&:hover": {
                                borderColor: theme.palette.primary.main,
                            }, // 🔥 Khi hover viền đậm hơn
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
                            autoComplete="off"
                            sx={{
                                flex: 1,
                                color: theme.palette.text.secondary,
                            }}
                        />
                    </Box>

                    {/* 🔹 Icon Buttons */}
                    <Box sx={{ display: "flex", gap: 1 }}>
                        <IconButton
                            sx={{
                                color: theme.palette.primary.light, // 🔥 Màu icon light
                                "&:hover": {
                                    color: theme.palette.primary.main,
                                }, // 🔥 Hover màu đậm hơn
                            }}
                        >
                            <Notifications />
                        </IconButton>
                        <IconButton
                            sx={{
                                color: theme.palette.primary.light,
                                "&:hover": {
                                    color: theme.palette.primary.main,
                                },
                            }}
                        >
                            <ShoppingCart />
                        </IconButton>
                        <IconButton
                            sx={{
                                color: theme.palette.primary.light,
                                "&:hover": {
                                    color: theme.palette.primary.main,
                                },
                            }}
                        >
                            <AccountCircle />
                        </IconButton>
                    </Box>
                </Toolbar>
            </Container>
        </AppBar>
    );
};

export default Header;
