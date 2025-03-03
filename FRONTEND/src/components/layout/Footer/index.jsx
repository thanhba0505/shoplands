import { useTheme } from "@emotion/react";
import { Box, Container, Typography, Link } from "@mui/material";

const Footer = () => {
    const theme = useTheme();
    return (
        <Box
            sx={{
                backgroundColor: theme.palette.primary.light,
                paddingY: theme.spacing(4),
                color: theme.palette.common.white,
            }}
        >
            <Container maxWidth="xl">
                {/* 🔹 Dùng Box với display="grid" thay vì Grid */}
                <Box
                    sx={{
                        display: "grid",
                        gridTemplateColumns: { xs: "1fr", md: "1fr 1fr 1fr" }, // Responsive: mobile 1 cột, desktop 3 cột
                        gap: 4,
                    }}
                >
                    {/* 🔹 Cột 1: Giới thiệu */}
                    <Box>
                        <Typography
                            variant="h6"
                            sx={{ fontWeight: "bold", marginBottom: "10px" }}
                        >
                            Giới thiệu
                        </Typography>
                        <Typography variant="body2">
                            Chúng tôi cung cấp những sản phẩm chất lượng với
                            dịch vụ tốt nhất.
                        </Typography>
                        <Typography variant="body2">
                            Địa chỉ: 123 Đường ABC, TP.HCM, Việt Nam
                        </Typography>
                        <Typography variant="body2">
                            Email: support@example.com
                        </Typography>
                        <Typography variant="body2">
                            Hotline: 0123 456 789
                        </Typography>
                    </Box>

                    {/* 🔹 Cột 2: Hỗ trợ khách hàng */}
                    <Box>
                        <Typography
                            variant="h6"
                            sx={{ fontWeight: "bold", marginBottom: "10px" }}
                        >
                            Hỗ trợ khách hàng
                        </Typography>
                        <Link href="#" underline="hover" color="inherit">
                            Chính sách bảo mật
                        </Link>
                        <br />
                        <Link href="#" underline="hover" color="inherit">
                            Điều khoản sử dụng
                        </Link>
                        <br />
                        <Link href="#" underline="hover" color="inherit">
                            Chính sách vận chuyển
                        </Link>
                        <br />
                        <Link href="#" underline="hover" color="inherit">
                            Hướng dẫn mua hàng
                        </Link>
                    </Box>

                    {/* 🔹 Cột 3: Kết nối với chúng tôi */}
                    <Box>
                        <Typography
                            variant="h6"
                            sx={{ fontWeight: "bold", marginBottom: "10px" }}
                        >
                            Kết nối với chúng tôi
                        </Typography>
                        <Box sx={{ display: "flex", gap: "10px" }}>
                            <Link href="#" underline="none">
                                <img
                                    src="/facebook.svg"
                                    alt="Facebook"
                                    width="32"
                                />
                            </Link>
                            <Link href="#" underline="none">
                                <img
                                    src="/twitter.svg"
                                    alt="Twitter"
                                    width="32"
                                />
                            </Link>
                            <Link href="#" underline="none">
                                <img
                                    src="/instagram.svg"
                                    alt="Instagram"
                                    width="32"
                                />
                            </Link>
                        </Box>
                        <Typography variant="body2" sx={{ marginTop: "10px" }}>
                            Đăng ký để nhận thông tin khuyến mãi
                        </Typography>
                    </Box>
                </Box>

                {/* 🔹 Dòng cuối cùng */}
                <Box
                    sx={{
                        textAlign: "center",
                        marginTop: "20px",
                        paddingTop: "10px",
                        borderTop: "1px solid #ddd",
                    }}
                >
                    <Typography variant="body2">
                        © 2025 MyShop. All rights reserved.
                    </Typography>
                </Box>
            </Container>
        </Box>
    );
};

export default Footer;
