import { AppBar, Toolbar, Container, Box } from "@mui/material";
import { useTheme } from "@mui/material/styles";
import Logo from "./Logo";
import Navigation from "./Navigation";
import SearchBar from "./SearchBar";
import HeaderIcons from "./HeaderIcons";

const Header = () => {
  const theme = useTheme();

  return (
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
          <Logo />
          <Navigation />
          <Box sx={{ display: "flex", gap: 3 }}>
            <SearchBar />
            <HeaderIcons />
          </Box>
        </Toolbar>
      </Container>
    </AppBar>
  );
};

export default Header;
