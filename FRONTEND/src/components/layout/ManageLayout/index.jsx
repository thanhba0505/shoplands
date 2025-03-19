import {
  AppBar,
  Toolbar,
  Container,
  Box,
  IconButton,
  ListItemButton,
  ListItem,
  ListItemIcon,
  ListItemText,
  List,
  Tooltip,
  Divider,
  Typography,
} from "@mui/material";
import { useTheme } from "@mui/material/styles";
import MenuIcon from "@mui/icons-material/Menu";
import MenuOpenIcon from "@mui/icons-material/MenuOpen";
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
import Path from "~/helpers/Path";
import { useNavigate } from "react-router-dom";

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
    path: "/orders",
    icon: <WysiwygRoundedIcon />,
  },
  {
    name: "Chờ đóng gói",
    tooltip: "Chờ đóng gói",
    path: "/orders",
    icon: <MarkunreadMailboxOutlinedIcon />,
  },
  {
    name: "Chờ giao hàng",
    tooltip: "Chờ giao hàng",
    path: "/orders",
    icon: <CardTravelRoundedIcon />,
  },
  {
    name: "Đang giao hàng",
    tooltip: "Đang giao hàng",
    path: "/orders",
    icon: <LocalShippingOutlinedIcon />,
  },
  {
    name: "Yêu cầu trả hàng",
    tooltip: "Yêu cầu trả hàng",
    path: "/orders",
    icon: <AssignmentReturnOutlinedIcon />,
  },
  {
    name: "Hoàn thành",
    tooltip: "Hoàn thành",
    path: "/orders",
    icon: <FactCheckOutlinedIcon />,
    divider: true,
  },
  {
    group: "Quản lý sản phẩm",
  },
  {
    name: "Tất cả sản phẩm",
    tooltip: "Tất cả sản phẩm",
    path: "/dashboard",
    icon: <BallotOutlinedIcon />,
  },
  {
    name: "Thêm sản phẩm",
    tooltip: "Thêm sản phẩm",
    path: "/orders",
    icon: <AddShoppingCartRoundedIcon />,
  },
  {
    name: "Kho hàng",
    tooltip: "Kho hàng",
    path: "/orders",
    icon: <Inventory2OutlinedIcon />,
  },
  {
    name: "Nhập kho",
    tooltip: "Nhập kho",
    path: "/orders",
    icon: <AddCardRoundedIcon />,
  },
  {
    name: "Đánh giá sản phẩm",
    tooltip: "Đánh giá sản phẩm",
    path: "/orders",
    icon: <RateReviewOutlinedIcon />,
    divider: true,
  },
  {
    group: "Quản lý khuyến mãi",
  },
  {
    name: "Giảm giá sản phẩm",
    tooltip: "Giảm giá sản phẩm",
    path: "/dashboard",
    icon: <SellOutlinedIcon />,
  },
  {
    name: "Mã giảm giá",
    tooltip: "Mã giảm giá",
    path: "/orders",
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
    path: "/dashboard",
    icon: <StorefrontOutlinedIcon />,
    divider: true,
  },
  {
    name: "Thông tin thanh toán",
    tooltip: "Thông tin thanh toán",
    path: "/dashboard",
    icon: <PaymentOutlinedIcon />,
    divider: true,
  },
];

const SideBarItem = ({ item, open }) => {
  const navigate = useNavigate();

  return (
    <>
      {item.group ? (
        <Box
          sx={{
            userSelect: "none",
            px: 2,
            maxHeight: open ? "300px" : 0,
            transition: "max-height 0.3s ease, opacity 0.3s ease",
            opacity: open ? 1 : 0,
          }}
        >
          <Typography variant="body2" sx={{ py: 1 }} noWrap>
            {item.group}
          </Typography>
        </Box>
      ) : (
        <>
          <ListItem
            onClick={() => navigate(Path.seller(item.path))}
            disablePadding
            sx={{ display: "block", overflow: "hidden", borderRadius: "8px" }}
          >
            <ListItemButton
              sx={[
                {
                  minHeight: 48,
                },
                open
                  ? {
                      justifyContent: "initial",
                    }
                  : {
                      justifyContent: "center",
                    },
              ]}
            >
              {open ? (
                <ListItemIcon
                  sx={[
                    {
                      minWidth: 0,
                      justifyContent: "center",
                    },
                    open
                      ? {
                          mr: 3,
                        }
                      : {
                          mr: "auto",
                        },
                  ]}
                >
                  {item.icon}
                </ListItemIcon>
              ) : (
                <Tooltip title={item.tooltip} placement="right">
                  <ListItemIcon
                    sx={[
                      {
                        minWidth: 0,
                        justifyContent: "center",
                      },
                      open
                        ? {
                            mr: 3,
                          }
                        : {
                            mr: "auto",
                          },
                    ]}
                  >
                    {item.icon}
                  </ListItemIcon>
                </Tooltip>
              )}

              <ListItemText
                primary={item.name}
                sx={[
                  {
                    textWrap: "nowrap",
                    transition: "all 0.3s",
                  },
                  open
                    ? {
                        opacity: 1,
                      }
                    : {
                        display: "none",
                        opacity: 0,
                      },
                ]}
              />
            </ListItemButton>
          </ListItem>
          {item.divider && <Divider sx={{ borderBottom: 1, mt: 2, mb: 2 }} />}
        </>
      )}
    </>
  );
};

const ManageLayout = ({ children }) => {
  const theme = useTheme();
  const [open, setOpen] = useState(true);

  return (
    <>
      <AppBar
        position="sticky"
        sx={{
          height: theme.custom?.headerHeight,
          backgroundColor: theme.palette.common.white,
          color: "#333",
          padding: "5px 0",
          boxShadow: theme.custom?.boxShadow,
          justifyContent: "center",
          paddingTop: 1,
        }}
      >
        <Container maxWidth="xl">
          <Toolbar
            sx={{
              display: "flex",
              justifyContent: "space-between",
              alignItems: "center",
              padding: "0px !important",
            }}
          >
            <Box>
              <IconButton
                onClick={() => setOpen(!open)}
                sx={{ color: theme.palette.primary.light }}
              >
                {open ? <MenuOpenIcon /> : <MenuIcon />}
              </IconButton>
              Logo
            </Box>
          </Toolbar>
        </Container>
      </AppBar>

      <Container maxWidth="xl">
        <Box
          sx={{
            display: "flex",
            flexDirection: "row",
            gap: 3,
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
              <List
                disablePadding
                sx={{
                  width: open ? 250 : 60,
                  transition: "all 0.3s",
                  // paddingX: open ? "20px" : "10px",
                }}
              >
                {NAVIGATION.map((item, index) => (
                  <SideBarItem key={index} item={item} open={open} />
                ))}
              </List>
            </Box>
          </PaperCustom>

          <Box
            sx={{
              pr: 2,
              height: `calc(100vh - ${theme.custom.headerHeight})`,
              overflowY: "auto",
              flexGrow: 1,
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
