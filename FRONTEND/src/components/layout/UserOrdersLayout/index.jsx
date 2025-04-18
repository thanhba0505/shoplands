import { Container, Box } from "@mui/material";
import { useTheme } from "@mui/material/styles";
import WysiwygRoundedIcon from "@mui/icons-material/WysiwygRounded";
import LocalShippingOutlinedIcon from "@mui/icons-material/LocalShippingOutlined";
import MarkunreadMailboxOutlinedIcon from "@mui/icons-material/MarkunreadMailboxOutlined";
import LocationOnRoundedIcon from "@mui/icons-material/LocationOnRounded";
import AccountCircleRoundedIcon from "@mui/icons-material/AccountCircleRounded";
import FactCheckOutlinedIcon from "@mui/icons-material/FactCheckOutlined";
import CardTravelRoundedIcon from "@mui/icons-material/CardTravelRounded";
import AllInboxRoundedIcon from "@mui/icons-material/AllInboxRounded";
import SidebarTab from "../SidebarTab";
import Header from "../Header";

const NAVIGATION = [
  {
    group: "Tài khoản",
  },
  {
    name: "Thông tin tài khoản",
    tooltip: "Thông tin tài khoản",
    path: "/user/profile",
    icon: <AccountCircleRoundedIcon />,
  },
  {
    name: "Sổ địa chỉ",
    tooltip: "Sổ địa chỉ",
    path: "/user/address-book",
    icon: <LocationOnRoundedIcon />,
    divider: true,
  },
  {
    group: "Đơn hàng của bạn",
  },
  {
    name: "Tất cả đơn hàng",
    tooltip: "Tất cả đơn hàng",
    path: "/user/orders/all",
    icon: <WysiwygRoundedIcon />,
  },
  {
    name: "Chưa thanh toán",
    tooltip: "Chưa thanh toán",
    path: "/user/orders/unpaid",
    icon: <MarkunreadMailboxOutlinedIcon />,
  },
  {
    name: "Chờ giao hàng",
    tooltip: "Chờ giao hàng",
    path: "/user/orders/waiting",
    icon: <CardTravelRoundedIcon />,
  },
  {
    name: "Đang giao hàng",
    tooltip: "Đang giao hàng",
    path: "/user/orders/shipping",
    icon: <LocalShippingOutlinedIcon />,
  },
  {
    name: "Đã hoàn thành",
    tooltip: "Đã hoàn thành",
    path: "/user/orders/completed",
    icon: <LocalShippingOutlinedIcon />,
  },
  {
    name: "Đơn hoàn trả",
    tooltip: "Đơn hoàn trả",
    path: "/user/orders/return",
    icon: <AllInboxRoundedIcon />,
  },
  {
    name: "Đơn hàng khác",
    tooltip: "Đơn khác",
    path: "/user/orders/other",
    icon: <FactCheckOutlinedIcon />,
  },
];

const UserOrdersLayout = ({ children }) => {
  const theme = useTheme();

  return (
    <>
      <Header />

      <Container maxWidth="xl">
        <Box
          sx={{
            display: "flex",
            flexDirection: "row",
            gap: 3,
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

export default UserOrdersLayout;
