import {
  Container,
  Box,
  List,
  ListItemText,
  ListItemIcon,
  Tooltip,
  ListItemButton,
  ListItem,
} from "@mui/material";
import { useTheme } from "@mui/material/styles";
import MenuIcon from "@mui/icons-material/Menu";
import MenuOpenIcon from "@mui/icons-material/MenuOpen";
import WysiwygRoundedIcon from "@mui/icons-material/WysiwygRounded";
import LocalShippingOutlinedIcon from "@mui/icons-material/LocalShippingOutlined";
import MarkunreadMailboxOutlinedIcon from "@mui/icons-material/MarkunreadMailboxOutlined";
import LocationOnRoundedIcon from "@mui/icons-material/LocationOnRounded";
import AccountCircleRoundedIcon from "@mui/icons-material/AccountCircleRounded";
import FactCheckOutlinedIcon from "@mui/icons-material/FactCheckOutlined";
import AllInboxRoundedIcon from '@mui/icons-material/AllInboxRounded';
import { useState } from "react";
import PaperCustom from "~/components/PaperCustom";
import SidebarTab from "../SidebarTab";
import Header from "../Header";

const NAVIGATION = [
  {
    group: "Tài khoản của tôi",
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
    name: "Đang đóng gói",
    tooltip: "Đang đóng gói",
    path: "/user/orders/packing",
    icon: <MarkunreadMailboxOutlinedIcon />,
  },
  {
    name: "Đang giao hàng",
    tooltip: "Đang giao hàng",
    path: "/user/orders/shipping",
    icon: <LocalShippingOutlinedIcon />,
  },
  {
    name: "Đã nhận hàng",
    tooltip: "Đã nhận hàng",
    path: "/user/orders/delivered",
    icon: <AllInboxRoundedIcon />,
  },
  {
    name: "Hoàn thành",
    tooltip: "Hoàn thành",
    path: "/user/orders/completed",
    icon: <FactCheckOutlinedIcon />,
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
              display: "flex",
              flexDirection: "column",
              justifyContent: "space-between",
              gap: 2,
            }}
          >
            <Box
              sx={{
                pr: 2,
                // height: `calc(100vh - ${theme.custom.headerHeight} - 3.5 * ${theme.custom.containerGap})`,
                overflowY: "auto",
              }}
            >
              <SidebarTab navigation={NAVIGATION} open={open} />
            </Box>

            <Box sx={{ pr: 2 }}>
              <Box sx={{ borderTop: "2px solid #ccc" }}>
                <List
                  disablePadding
                  sx={{
                    width: open ? 250 : 60,
                    transition: "all 0.3s",
                  }}
                >
                  <ListItem
                    onClick={() => setOpen(!open)}
                    disablePadding
                    sx={{
                      display: "block",
                      overflow: "hidden",
                      borderRadius: "8px",
                      // backgroundColor: Path.checkStartsWith(
                      //   item.path,
                      //   Path.getPathFromIndex(location.pathname, 2)
                      // )
                      //   ? theme.custom.primary.strongLight
                      //   : "transparent",
                      my: 0.5,
                    }}
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
                              color: theme.palette.primary.light,
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
                          {<MenuOpenIcon />}
                        </ListItemIcon>
                      ) : (
                        <Tooltip title={"Mở rộng"} placement="right">
                          <ListItemIcon
                            sx={[
                              {
                                color: theme.palette.primary.light,
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
                            {<MenuIcon />}
                          </ListItemIcon>
                        </Tooltip>
                      )}

                      <ListItemText
                        primary={"Đóng"}
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
                </List>
              </Box>
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
