import { Box } from "@mui/material";
import ButtonNavigate from "~/components/ButtonNavigate";
import Path from "~/helpers/Path";

const Navigation = () => {
    return (
        <Box sx={{ display: "flex", gap: 1 }}>
            <ButtonNavigate to={Path.home()} sx={{ width: "120px" }}>
                Trang chủ
            </ButtonNavigate>
            <ButtonNavigate to={Path.products()} sx={{ width: "120px" }}>
                Sản phẩm
            </ButtonNavigate>
            <ButtonNavigate to={Path.introduce()} sx={{ width: "120px" }}>
                Giới thiệu
            </ButtonNavigate>
            <ButtonNavigate to={Path.contact()} sx={{ width: "120px" }}>
                Liên hệ
            </ButtonNavigate>
        </Box>
    );
};

export default Navigation;
