import { useState } from "react";
import { IconButton, Menu, MenuItem } from "@mui/material";
import { useTheme } from "@mui/material/styles";

const MenuIcon = ({ icon, menuItems }) => {
  const theme = useTheme();
  const [menuAnchor, setMenuAnchor] = useState(null);

  const handleOpenMenu = (event) => {
    setMenuAnchor(event.currentTarget);
  };

  const handleCloseMenu = () => {
    setMenuAnchor(null);
  };

  return (
    <>
      <IconButton
        onClick={handleOpenMenu}
        sx={{ color: theme.palette.common.white }}
        size="medium"
      >
        {icon}
      </IconButton>
      <Menu
        anchorEl={menuAnchor}
        open={Boolean(menuAnchor)}
        onClose={handleCloseMenu}
        anchorOrigin={{ vertical: "bottom", horizontal: "right" }}
        transformOrigin={{ vertical: "top", horizontal: "right" }}
      >
        {menuItems?.map((item, index) => (
          <MenuItem
            key={index}
            sx={{ minWidth: "200px" }}
            onClick={(event) => {
              handleCloseMenu();
              if (item.onClick) {
                item.onClick(event);
              }
            }}
          >
            {item.label}
          </MenuItem>
        ))}
      </Menu>
    </>
  );
};

export default MenuIcon;
