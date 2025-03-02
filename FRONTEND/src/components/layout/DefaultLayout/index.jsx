import Header from "../Header";
import Footer from "../Footer";
import { Container } from "@mui/material";
import { useTheme } from "@mui/material/styles";

function DefaultLayout({ children }) {
    const theme = useTheme();

    return (
        <>
            <Header />
            <Container sx={{ paddingY: theme.custom.paddingYContainer }}>
                {children}
            </Container>
            <Footer />
        </>
    );
}

export default DefaultLayout;
