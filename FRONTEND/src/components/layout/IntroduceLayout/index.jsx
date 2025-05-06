import { Container, Box } from "@mui/material";
import { useTheme } from "@mui/material/styles";
import ExitToAppRoundedIcon from "@mui/icons-material/ExitToAppRounded";
import PaymentRoundedIcon from "@mui/icons-material/PaymentRounded";
import ShoppingCartOutlinedIcon from "@mui/icons-material/ShoppingCartOutlined";
import LocalShippingOutlinedIcon from "@mui/icons-material/LocalShippingOutlined";
import SidebarTab from "../SidebarTab";
import GppGoodOutlinedIcon from "@mui/icons-material/GppGoodOutlined";
import InfoOutlinedIcon from "@mui/icons-material/InfoOutlined";
import AssignmentOutlinedIcon from "@mui/icons-material/AssignmentOutlined";
import Header from "../Header";

const NAVIGATION = [
  {
    group: "Giới thiệu",
  },
  {
    name: "Về dự án",
    tooltip: "Về dự án",
    path: "/introduce/about",
    icon: <InfoOutlinedIcon />,
    divider: true,
  },
  {
    group: "Hướng dẫn sử dụng",
  },
  {
    name: "Hướng dẫn mua hàng",
    tooltip: "Hướng dẫn mua hàng",
    path: "/introduce/buying-guide",
    icon: <ShoppingCartOutlinedIcon />,
  },
  {
    name: "Hướng dẫn thanh toán",
    tooltip: "Hướng dẫn thanh toán",
    path: "/introduce/payment-nstructions",
    icon: <PaymentRoundedIcon />,
  },
  {
    name: "Đăng ký bán hàng",
    tooltip: "Đăng ký bán hàng",
    path: "/introduce/sales-registration-guide",
    icon: <ExitToAppRoundedIcon />,
    divider: true,
  },
  {
    group: "Chính sách và điều khoản",
  },
  {
    name: "Chính sách vận chuyển",
    tooltip: "Chính sách vận chuyển",
    path: "/introduce/shipping-policy",
    icon: <LocalShippingOutlinedIcon />,
  },
  {
    name: "Chính sách bảo mật",
    tooltip: "Chính sách bảo mật",
    path: "/introduce/privacy-policy",
    icon: <GppGoodOutlinedIcon />,
  },
  {
    name: "Điều khoản sử dụng",
    tooltip: "Điều khoản sử dụng",
    path: "/introduce/terms-of-use",
    icon: <AssignmentOutlinedIcon />,
  },
];

const IntroduceLayout = ({ children }) => {
  const theme = useTheme();

  return (
    <>
      <Header />

      <Container maxWidth="lg">
        <Box
          sx={{
            display: "flex",
            flexDirection: "row",
            gap: 2,
          }}
        >
          <SidebarTab
            navigation={NAVIGATION}
            sx={{
              pr: 0,
              marginTop: 3,
              height: `calc(100vh - ${theme.custom.headerHeight} - 2 * ${theme.custom.containerGap})`,
            }}
          />

          <Box
            sx={{
              height: `calc(100vh - ${theme.custom.headerHeight})`,
              overflowY: "auto",
              flexGrow: 1,
              pr: 1,
            }}
          >
            <Box
              sx={{
                marginY: 3,
                px: "4px",
              }}
            >
              {children}
            </Box>
          </Box>
        </Box>
      </Container>
    </>
  );
};

export default IntroduceLayout;
