import { Container, useTheme } from "@mui/material";
import PaperCustom from "~/components/PaperCustom";

const Home = () => {
    const theme = useTheme();
    return (
        <>
            <Container
                maxWidth="xl"
                sx={{
                    height: "200px",
                }}
            >
                <PaperCustom>Danh mục</PaperCustom>
            </Container>
            <Container
                maxWidth="xl"
                sx={{
                    height: "200px",
                }}
            >
                <PaperCustom>Sản phẩm</PaperCustom>
            </Container>
            <Container
                maxWidth="xl"
                sx={{
                    height: "200px",
                }}
            >
                <PaperCustom>Sản phẩm</PaperCustom>
            </Container>
        </>
    );
};

export default Home;
