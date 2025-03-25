import {
  Box,
  ListItemButton,
  ListItem,
  ListItemIcon,
  ListItemText,
  List,
  Tooltip,
  Divider,
  Typography,
} from "@mui/material";
import { useLocation, useNavigate } from "react-router-dom";
import Path from "~/helpers/Path";
import theme from "~/theme";

const SidebarItem = ({ item, open }) => {
  const navigate = useNavigate();
  const location = useLocation();

  const handleOnClick = () => {
    navigate(Path.seller(item.path));
  };

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
            onClick={() => handleOnClick()}
            disablePadding
            sx={{
              display: "block",
              overflow: "hidden",
              borderRadius: "8px",
              backgroundColor: Path.checkStartsWith(
                item.path,
                Path.getPathFromIndex(location.pathname, 2)
              )
                ? theme.custom.primary.strongLight
                : "transparent",
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
                  {item.icon}
                </ListItemIcon>
              ) : (
                <Tooltip title={item.tooltip} placement="right">
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

const SidebarTab = ({ navigation, open }) => {
  return (
    <List
      disablePadding
      sx={{
        width: open ? 250 : 60,
        transition: "all 0.3s",
      }}
    >
      {navigation.map((item, index) => (
        <SidebarItem key={index} item={item} open={open} />
      ))}
    </List>
  );
};

export default SidebarTab;
