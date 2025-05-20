import { AppBar, Toolbar, Container, Box, Avatar } from "@mui/material";
import { useTheme } from "@mui/material/styles";
import DashboardOutlinedIcon from "@mui/icons-material/DashboardOutlined";
import PermIdentityOutlinedIcon from "@mui/icons-material/PermIdentityOutlined";
import ContactEmergencyOutlinedIcon from '@mui/icons-material/ContactEmergencyOutlined';
import RecentActorsOutlinedIcon from '@mui/icons-material/RecentActorsOutlined';
import ContactlessOutlinedIcon from '@mui/icons-material/ContactlessOutlined';
import PeopleOutlineOutlinedIcon from "@mui/icons-material/PeopleOutlineOutlined";
import LockPersonOutlinedIcon from "@mui/icons-material/LockPersonOutlined";
import HowToRegOutlinedIcon from "@mui/icons-material/HowToRegOutlined";
import Groups2OutlinedIcon from '@mui/icons-material/Groups2Outlined';
import Diversity2OutlinedIcon from '@mui/icons-material/Diversity2Outlined';
import VpnKeyOutlinedIcon from '@mui/icons-material/VpnKeyOutlined';
import BlockOutlinedIcon from '@mui/icons-material/BlockOutlined';
import BrowseGalleryOutlinedIcon from '@mui/icons-material/BrowseGalleryOutlined';
import CategoryOutlinedIcon from '@mui/icons-material/CategoryOutlined';
import SidebarTab from "../SidebarTab";
import Path from "~/helpers/Path";
import MenuIcon from "~/components/MenuIcon";
import { useDispatch } from "react-redux";
import { useNavigate } from "react-router-dom";
import { startLoading, stopLoading } from "~/redux/loadingSlice";
import Log from "~/helpers/Log";
import { useSnackbar } from "notistack";
import axiosWithAuth from "~/utils/axiosWithAuth";
import Api from "~/helpers/Api";
import { logout } from "~/redux/authSlice";

const NAVIGATION = [
  {
    name: "Bảng điều khiển",
    tooltip: "Bảng điều khiển",
    path: "/admin/dashboard",
    icon: <DashboardOutlinedIcon />,
    divider: true,
  },
  {
    group: "Liên hệ",
  },
  {
    name: "Tất cả",
    tooltip: "Tất cả",
    path: "/admin/contact/all",
    icon: <ContactEmergencyOutlinedIcon />,
  },
  {
    name: "Chưa phản hồi",
    tooltip: "Chưa phản hồi",
    path: "/admin/contact/unreplied",
    icon: <RecentActorsOutlinedIcon />,
  },
  {
    name: "Đã phản hồi",
    tooltip: "Đã phản hồi",
    path: "/admin/contact/replied",
    icon: <ContactlessOutlinedIcon />,
    divider: true,
  },
  {
    group: "Quản lý người bán",
  },
  {
    name: "Tất cả người bán",
    tooltip: "Tất cả người bán",
    path: "/admin/sellers/all",
    icon: <PeopleOutlineOutlinedIcon />,
  },
  {
    name: "Đang hoạt động",
    tooltip: "Đang hoạt động",
    path: "/admin/sellers/active",
    icon: <PermIdentityOutlinedIcon />,
  },
  {
    name: "Đã khóa",
    tooltip: "Đã khóa",
    path: "/admin/sellers/locked",
    icon: <LockPersonOutlinedIcon />,
  },
  {
    name: "Chờ duyệt người bán",
    tooltip: "Chờ duyệt người bán",
    path: "/admin/sellers/inactive",
    icon: <HowToRegOutlinedIcon />,
    divider: true,
  },
  {
    group: "Quản lý người mua",
  },
  {
    name: "Tất cả người mua",
    tooltip: "Tất cả người mua",
    path: "/admin/users/all",
    icon: <Groups2OutlinedIcon />,
  },
  {
    name: "Đang hoạt động",
    tooltip: "Đang hoạt động",
    path: "/admin/users/active",
    icon: <Diversity2OutlinedIcon />,
  },
  {
    name: "Đã khóa",
    tooltip: "Đã khóa",
    path: "/admin/users/locked",
    icon: <VpnKeyOutlinedIcon />,
    divider: true,
  },
  {
    group: "Quản lý sản phẩm",
  },
  {
    name: "Tất cả sản phẩm",
    tooltip: "Tất cả sản phẩm",
    path: "/admin/products/all",
    icon: <CategoryOutlinedIcon />,
  },
  {
    name: "Còn hoạt động",
    tooltip: "Còn hoạt động",
    path: "/admin/products/active",
    icon: <BrowseGalleryOutlinedIcon />,
  },
  {
    name: "Đã khóa",
    tooltip: "Đã khóa",
    path: "/admin/products/locked",
    icon: <BlockOutlinedIcon />,
  },
];

const AdminLayout = ({ children }) => {
  const theme = useTheme();
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
              Chào mừng Admin Shoplands
              <MenuIcon
                icon={
                  <Avatar
                    sx={{
                      bgcolor: "white",
                      color: "primary.main",
                      fontWeight: "bold",
                    }}
                  >
                    A
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

export default AdminLayout;
