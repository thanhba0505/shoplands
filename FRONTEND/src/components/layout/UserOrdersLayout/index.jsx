import { Container, Box } from "@mui/material";
import { useTheme } from "@mui/material/styles";
import RateReviewOutlinedIcon from "@mui/icons-material/RateReviewOutlined";
import WysiwygRoundedIcon from "@mui/icons-material/WysiwygRounded";
import LocalShippingOutlinedIcon from "@mui/icons-material/LocalShippingOutlined";
import MarkunreadMailboxOutlinedIcon from "@mui/icons-material/MarkunreadMailboxOutlined";
import CardTravelRoundedIcon from "@mui/icons-material/CardTravelRounded";
import DashboardOutlinedIcon from "@mui/icons-material/DashboardOutlined";
import AddShoppingCartRoundedIcon from "@mui/icons-material/AddShoppingCartRounded";
import AddCardRoundedIcon from "@mui/icons-material/AddCardRounded";
import Inventory2OutlinedIcon from "@mui/icons-material/Inventory2Outlined";
import BallotOutlinedIcon from "@mui/icons-material/BallotOutlined";
import SellOutlinedIcon from "@mui/icons-material/SellOutlined";
import AssignmentReturnOutlinedIcon from "@mui/icons-material/AssignmentReturnOutlined";
import StorefrontOutlinedIcon from "@mui/icons-material/StorefrontOutlined";
import LocalAtmOutlinedIcon from "@mui/icons-material/LocalAtmOutlined";
import PaymentOutlinedIcon from "@mui/icons-material/PaymentOutlined";
import FactCheckOutlinedIcon from "@mui/icons-material/FactCheckOutlined";
import { useState } from "react";
import PaperCustom from "~/components/PaperCustom";
import SidebarTab from "../SidebarTab";
import Header from "../Header";

const NAVIGATION = [
  {
    name: "Bảng điều khiển",
    tooltip: "Bảng điều khiển",
    path: "/dashboard",
    icon: <DashboardOutlinedIcon />,
    divider: true,
  },
  {
    group: "Quản lý đơn hàng",
  },
  {
    name: "Tất cả đơn hàng",
    tooltip: "Tất cả đơn hàng",
    path: "/orders/all",
    icon: <WysiwygRoundedIcon />,
  },
  {
    name: "Chờ đóng gói",
    tooltip: "Chờ đóng gói",
    path: "/orders/packing",
    icon: <MarkunreadMailboxOutlinedIcon />,
  },
  {
    name: "Đã đóng gói",
    tooltip: "Đã đóng gói",
    path: "/orders/packed",
    icon: <CardTravelRoundedIcon />,
  },
  {
    name: "Đang giao hàng",
    tooltip: "Đang giao hàng",
    path: "/orders/shipping",
    icon: <LocalShippingOutlinedIcon />,
  },
  {
    name: "Yêu cầu trả hàng",
    tooltip: "Yêu cầu trả hàng",
    path: "/orders/delivered",
    icon: <AssignmentReturnOutlinedIcon />,
  },
  {
    name: "Hoàn thành",
    tooltip: "Hoàn thành",
    path: "/orders/completed",
    icon: <FactCheckOutlinedIcon />,
    divider: true,
  },
  {
    group: "Quản lý sản phẩm",
  },
  {
    name: "Tất cả sản phẩm",
    tooltip: "Tất cả sản phẩm",
    path: "/products/all",
    icon: <BallotOutlinedIcon />,
  },
  {
    name: "Thêm sản phẩm",
    tooltip: "Thêm sản phẩm",
    path: "/products/new",
    icon: <AddShoppingCartRoundedIcon />,
  },
  {
    name: "Kho hàng",
    tooltip: "Kho hàng",
    path: "/products/inventory",
    icon: <Inventory2OutlinedIcon />,
  },
  {
    name: "Nhập kho",
    tooltip: "Nhập kho",
    path: "/products/import-products",
    icon: <AddCardRoundedIcon />,
  },
  {
    name: "Đánh giá sản phẩm",
    tooltip: "Đánh giá sản phẩm",
    path: "/products/reviews",
    icon: <RateReviewOutlinedIcon />,
    divider: true,
  },
  {
    group: "Quản lý khuyến mãi",
  },
  {
    name: "Giảm giá sản phẩm",
    tooltip: "Giảm giá sản phẩm",
    path: "/promotions/product-discount",
    icon: <SellOutlinedIcon />,
  },
  {
    name: "Mã giảm giá",
    tooltip: "Mã giảm giá",
    path: "/promotions/coupon",
    icon: <LocalAtmOutlinedIcon />,
    divider: true,
  },
  // {
  //   group: "Quản lý khách hàng",
  // },
  {
    group: "Cài đặt cửa hàng",
  },
  {
    name: "Thông tin cửa hàng",
    tooltip: "Thông tin cửa hàng",
    path: "/settings/shop",
    icon: <StorefrontOutlinedIcon />,
  },
  {
    name: "Thông tin thanh toán",
    tooltip: "Thông tin thanh toán",
    path: "/settings/payment",
    icon: <PaymentOutlinedIcon />,
    divider: true,
  },
];

const ManageLayout = ({ children }) => {
  const theme = useTheme();
  const [open, setOpen] = useState(true);

  return (
    <>
      <Header />

      <Container maxWidth="xl">
        <Box
          sx={{
            display: "flex",
            flexDirection: "row",
            gap: 2,
          }}
        >
          <PaperCustom
            sx={{
              pr: 0,
              marginTop: 3,
              height: `calc(100vh - ${theme.custom.headerHeight} - 2 * ${theme.custom.containerGap})`,
            }}
          >
            <Box
              sx={{
                pr: 2,
                height: `calc(100vh - ${theme.custom.headerHeight} - 3.5 * ${theme.custom.containerGap})`,
                overflowY: "auto",
              }}
            >
              <SidebarTab navigation={NAVIGATION} open={open} />
            </Box>
          </PaperCustom>

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

export default ManageLayout;
