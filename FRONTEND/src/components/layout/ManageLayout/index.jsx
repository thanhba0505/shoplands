import {
  AppBar,
  Toolbar,
  Container,
  Box,
  IconButton,
  Icon,
  Button,
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
import SpaceDashboardIcon from "@mui/icons-material/SpaceDashboard";
import PointOfSaleRoundedIcon from "@mui/icons-material/PointOfSaleRounded";
import React, { useState } from "react";
import PaperCustom from "~/components/PaperCustom";

const NAVIGATION = [
  {
    group: "Bảng điều khiển",
  },
  {
    name: "Dashboard",
    path: "/",
    icon: <SpaceDashboardIcon />,
  },
  {
    name: "Orders",
    path: "/orders",
    icon: <PointOfSaleRoundedIcon />,
    divider: true,
  },
];

const SideBarItem = ({ item, open }) => {
  return (
    <>
      {item.group ? (
        <Box
          sx={{
            maxHeight: open ? "300px" : 0,
            transition: "max-height 0.3s ease, opacity 0.3s ease",
            opacity: open ? 1 : 0,
          }}
        >
          <Typography noWrap>
            {item.group}
          </Typography>
        </Box>
      ) : (
        <>
          <ListItem disablePadding sx={{ display: "block" }}>
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

              <ListItemText
                primary={item.name}
                sx={[
                  {
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
          {item.divider && (
            <Divider sx={{ display: open ? "none" : "block" }} />
          )}
        </>
      )}
    </>
  );
};

const ManageLayout = ({ children }) => {
  const theme = useTheme();

  const [open, setOpen] = useState(false);

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
            marginTop: 3,
            gap: 2,
          }}
        >
          <PaperCustom>
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
          </PaperCustom>

          <Box sx={{ flex: 1, paddingLeft: 2 }}>{children}</Box>
        </Box>
      </Container>
    </>
  );
};

export default ManageLayout;
