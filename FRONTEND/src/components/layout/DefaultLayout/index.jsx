import Header from "../Header";
import Footer from "../Footer";
import { Box } from "@mui/material";
import { useTheme } from "@mui/material/styles";

function DefaultLayout({ children }) {
    const theme = useTheme();

    return (
        <Box minWidth={"1100px"}>
            <Header />

            <Box
                sx={{
                    display: "flex",
                    flexDirection: "column",
                    paddingY: theme.custom?.containerGap,
                    gap: 2,
                    backgroundColor: theme.palette.common.white,
                }}
            >
                {children}
            </Box>

            <Footer />
        </Box>
    );
}

export default DefaultLayout;
