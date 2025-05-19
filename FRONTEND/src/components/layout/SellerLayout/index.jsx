import { AppBar, Toolbar, Container, Box, Avatar } from "@mui/material";
import { useTheme } from "@mui/material/styles";
import WysiwygRoundedIcon from "@mui/icons-material/WysiwygRounded";
import LocalShippingOutlinedIcon from "@mui/icons-material/LocalShippingOutlined";
import CardTravelRoundedIcon from "@mui/icons-material/CardTravelRounded";
import DashboardOutlinedIcon from "@mui/icons-material/DashboardOutlined";
import AddShoppingCartRoundedIcon from "@mui/icons-material/AddShoppingCartRounded";
import BallotOutlinedIcon from "@mui/icons-material/BallotOutlined";
import AllInboxRoundedIcon from "@mui/icons-material/AllInboxRounded";
import StorefrontOutlinedIcon from "@mui/icons-material/StorefrontOutlined";
import LocalAtmOutlinedIcon from "@mui/icons-material/LocalAtmOutlined";
import FactCheckOutlinedIcon from "@mui/icons-material/FactCheckOutlined";
import FiberSmartRecordRoundedIcon from "@mui/icons-material/FiberSmartRecordRounded";
import LockOutlinedIcon from "@mui/icons-material/LockOutlined";
import ViewStreamRoundedIcon from "@mui/icons-material/ViewStreamRounded";
import SidebarTab from "../SidebarTab";
import Path from "~/helpers/Path";
import MenuIcon from "~/components/MenuIcon";
import { AccountCircle } from "@mui/icons-material";
import Auth from "~/helpers/Auth";
import { useDispatch, useSelector } from "react-redux";
import { useNavigate } from "react-router-dom";
import { startLoading, stopLoading } from "~/redux/loadingSlice";
import Log from "~/helpers/Log";
import { useSnackbar } from "notistack";
import axiosWithAuth from "~/utils/axiosWithAuth";
import Api from "~/helpers/Api";
import { logout } from "~/redux/authSlice";
import QueryBuilderRoundedIcon from "@mui/icons-material/QueryBuilderRounded";
import AddToQueueRoundedIcon from "@mui/icons-material/AddToQueueRounded";
import Format from "~/helpers/Format";

const NAVIGATION = [
  {
    name: "Bảng điều khiển",
    tooltip: "Bảng điều khiển",
    path: "/seller/dashboard",
    icon: <DashboardOutlinedIcon />,
    divider: true,
  },
  {
    group: "Quản lý đơn hàng",
  },
  {
    name: "Tất cả đơn hàng",
    tooltip: "Tất cả đơn hàng",
    path: "/seller/orders/all",
    icon: <WysiwygRoundedIcon />,
  },
  {
    name: "Chờ giao hàng",
    tooltip: "Chờ giao hàng",
    path: "/seller/orders/waiting",
    icon: <CardTravelRoundedIcon />,
  },
  {
    name: "Đang giao hàng",
    tooltip: "Đang giao hàng",
    path: "/seller/orders/shipping",
    icon: <LocalShippingOutlinedIcon />,
  },
  {
    name: "Đã hoàn thành",
    tooltip: "Đã hoàn thành",
    path: "/seller/orders/completed",
    icon: <FactCheckOutlinedIcon />,
  },
  {
    name: "Đơn hoàn trả",
    tooltip: "Đơn hoàn trả",
    path: "/seller/orders/return",
    icon: <AllInboxRoundedIcon />,
  },
  {
    name: "Đơn hàng khác",
    tooltip: "Đơn hàng khác",
    path: "/seller/orders/other",
    icon: <FiberSmartRecordRoundedIcon />,
    divider: true,
  },
  {
    group: "Quản lý sản phẩm",
  },
  {
    name: "Tất cả sản phẩm",
    tooltip: "Tất cả sản phẩm",
    path: "/seller/products/all",
    icon: <BallotOutlinedIcon />,
  },
  {
    name: "Còn hoạt động",
    tooltip: "Còn hoạt động",
    path: "/seller/products/active",
    icon: <ViewStreamRoundedIcon />,
  },
  {
    name: "Đã bị khóa",
    tooltip: "Đã bị khóa",
    path: "/seller/products/locked",
    icon: <LockOutlinedIcon />,
  },
  {
    name: "Thêm sản phẩm",
    tooltip: "Thêm sản phẩm",
    path: "/seller/products/new",
    icon: <AddShoppingCartRoundedIcon />,
    divider: true,
  },
  // {
  //   name: "Đánh giá sản phẩm",
  //   tooltip: "Đánh giá sản phẩm",
  //   path: "/seller/products/reviews",
  //   icon: <RateReviewOutlinedIcon />,
  // },
  {
    group: "Quản lý khuyến mãi",
  },
  {
    name: "Mã giảm giá",
    tooltip: "Mã giảm giá",
    path: "/seller/promotions/coupon",
    icon: <LocalAtmOutlinedIcon />,
  },
  {
    name: "Mã hết hạn",
    tooltip: "Mã hết hạn",
    path: "/seller/promotions/expired",
    icon: <QueryBuilderRoundedIcon />,
  },
  {
    name: "Thêm mã mới",
    tooltip: "Thêm mã mới",
    path: "/seller/promotions/new",
    icon: <AddToQueueRoundedIcon />,
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
    path: "/seller/settings",
    icon: <StorefrontOutlinedIcon />,
    divider: true,
  },
  // {
  //   name: "Thông tin thanh toán",
  //   tooltip: "Thông tin thanh toán",
  //   path: "/seller/settings/payment",
  //   icon: <PaymentOutlinedIcon />,
  // },
];

const SellerLayout = ({ children }) => {
  const theme = useTheme();
  const seller = Auth.getSeller();
  const logo = useSelector((state) => state?.auth?.account?.logo);
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
      Log.error(error.response?.data?.message);
    } finally {
      dispatch(stopLoading());
    }
  };

  return (
    <>
      <AppBar
        position="sticky"
        sx={{
          height: theme.custom?.headerHeight,
          backgroundColor: theme.palette.primary.dark,
          color: "#fff",
          padding: "5px 0",
          boxShadow: theme.custom?.boxShadow,
          justifyContent: "center",
          paddingTop: 1,
        }}
      >
        <Container maxWidth="xl" sx={{ height: "100%" }}>
          <Toolbar
            sx={{
              display: "flex",
              justifyContent: "space-between",
              alignItems: "center",
              padding: "0px !important",
              height: "100%",
            }}
          >
            <Box
              sx={{ height: "100%", cursor: "pointer" }}
              onClick={() => navigate(Path.sellerDashboard())}
            >
              <img
                style={{
                  display: "block",
                  objectFit: "cover",
                  height: "100%",
                  width: "200px",
                }}
                src={Path.publicLogo1()}
                alt="logo"
              />
            </Box>

            <Box
              sx={{
                height: "100%",
                display: "flex",
                alignItems: "center",
                gap: 2,
              }}
            >
              Ví Shoplands: {Format.formatCurrency(seller?.coin)}
              <MenuIcon
                icon={
                  <Avatar
                    src={Path.publicAvatar(logo) ? Path.publicAvatar(logo) : ""}
                  >
                    <AccountCircle fontSize="large" />
                  </Avatar>
                }
                menuItems={[
                  {
                    label: "Đăng xuất",
                    onClick: handleLogout,
                  },
                ]}
              />
            </Box>
          </Toolbar>
        </Container>
      </AppBar>

      <Container maxWidth="xl">
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

export default SellerLayout;
