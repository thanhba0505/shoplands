import { Box, Container } from "@mui/material";

function Header() {
    return (
        <>
            <Container maxWidth="lg">
                <Box sx={{ bgcolor: "#cfe8fc", height: "10vh" }}>Header</Box>
            </Container>
        </>
    );
}

export default Header;
