import { Container } from "@mui/material";
import PaperCustom from "~/components/PaperCustom";
import CategoryList from "./CategoryList";
import BestSellingProducts from "./BestSellingProduct";

const Home = () => {
    return (
        <>
            {/* <CategoryList /> */}
            <BestSellingProducts />
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
