import { Container } from "@mui/material";
import PaperCustom from "~/components/PaperCustom";
import CategoryList from "./CategoryList";

const Home = () => {
    return (
        <>
            <CategoryList />
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
