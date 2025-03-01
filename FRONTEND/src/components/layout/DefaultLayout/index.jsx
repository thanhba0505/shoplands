import Header from "../Header";
import Footer from "../Footer";
import { Container, Typography } from "@mui/material";

function DefaultLayout({ children }) {
    return (
        <>
            <Header />
            <Container>
                <Typography variant="h3">{children}</Typography>
            </Container>
            <Footer />
        </>
    );
}

export default DefaultLayout;
