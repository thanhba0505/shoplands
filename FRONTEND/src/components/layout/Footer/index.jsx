import { useTheme } from "@emotion/react";
import { Box, Container, Typography } from "@mui/material";
import { useNavigate } from "react-router-dom";
import Path from "~/helpers/Path";

const Footer = () => {
  const theme = useTheme();
  const navigate = useNavigate();
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
            gridTemplateColumns: { xs: "1fr", md: "2fr 1fr 1fr" }, // Responsive: mobile 1 cột, desktop 3 cột
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
              Shoplands là dự án xây dựng hệ thống sàn thương mại điện tử đa
              người dùng, cho phép người bán đăng sản phẩm, quản lý đơn hàng và
              tương tác với khách hàng trên một giao diện hiện đại, thân thiện.
            </Typography>
            <Typography variant="body2" sx={{ mt: 0.5 }}>
              Địa chỉ: 123 Đường ABC, TP.HCM, Việt Nam
            </Typography>
            <Typography variant="body2" sx={{ mt: 0.5 }}>
              Email: lethanhba0505@gmail.com
            </Typography>
            <Typography variant="body2">Hotline: 037433542</Typography>
          </Box>

          {/* 🔹 Cột 3: Kết nối với chúng tôi */}
          <Box>
            <Typography
              variant="h6"
              sx={{ fontWeight: "bold", marginBottom: "10px" }}
            >
              Hỗ trợ khách hàng
            </Typography>

            <Typography
              variant="body2"
              sx={{
                "&:hover": { textDecoration: "underline" },
                cursor: "pointer",
                width: "max-content",
                mt: 0.5,
              }}
              onClick={() => navigate(Path.introduce("buying-guide"))}
            >
              Hướng dẫn mua hàng
            </Typography>

            <Typography
              variant="body2"
              sx={{
                "&:hover": { textDecoration: "underline" },
                cursor: "pointer",
                width: "max-content",
                mt: 0.5,
              }}
              onClick={() => navigate(Path.introduce("payment-nstructions"))}
            >
              Hướng dẫn thanh toán
            </Typography>

            <Typography
              variant="body2"
              sx={{
                "&:hover": { textDecoration: "underline" },
                cursor: "pointer",
                width: "max-content",
                mt: 0.5,
              }}
              onClick={() =>
                navigate(Path.introduce("sales-registration-guide"))
              }
            >
              Hướng dẫn đăng ký bán hàng
            </Typography>

            <Typography
              variant="body2"
              sx={{
                "&:hover": { textDecoration: "underline" },
                cursor: "pointer",
                width: "max-content",
                mt: 0.5,
              }}
              onClick={() => navigate(Path.contact())}
            >
              Liên hệ quản trị viên
            </Typography>
          </Box>

          {/* 🔹 Cột 2: Chính sách và điều khoản */}
          <Box>
            <Typography
              variant="h6"
              sx={{ fontWeight: "bold", marginBottom: "10px" }}
            >
              Chính sách và điều khoản
            </Typography>

            <Typography
              variant="body2"
              sx={{
                "&:hover": { textDecoration: "underline" },
                cursor: "pointer",
                width: "max-content",
                mt: 0.5,
              }}
              onClick={() => navigate(Path.introduce("shipping-policy"))}
            >
              Chính sách vận chuyển
            </Typography>

            <Typography
              variant="body2"
              sx={{
                "&:hover": { textDecoration: "underline" },
                cursor: "pointer",
                width: "max-content",
                mt: 0.5,
              }}
              onClick={() => navigate(Path.introduce("privacy-policy"))}
            >
              Chính sách bảo mật
            </Typography>

            <Typography
              variant="body2"
              sx={{
                "&:hover": { textDecoration: "underline" },
                cursor: "pointer",
                width: "max-content",
                mt: 0.5,
              }}
              onClick={() => navigate(Path.introduce("terms-of-use"))}
            >
              Điều khoản dịch vụ
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
            © 2025 Shoplands. All rights reserved
          </Typography>
        </Box>
      </Container>
    </Box>
  );
};

export default Footer;
