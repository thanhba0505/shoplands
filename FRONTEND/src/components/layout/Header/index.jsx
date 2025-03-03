import { AppBar, Toolbar, Container } from "@mui/material";
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
                height: theme.custom?.headerHeight || "74px",
                backgroundColor: theme.palette.common.white,
                color: "#333",
                padding: "5px 0",
                boxShadow: theme.custom?.boxShadow,
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
                    <SearchBar />
                    <HeaderIcons />
                </Toolbar>
            </Container>
        </AppBar>
    );
};

export default Header;
