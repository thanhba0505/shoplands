import { Box } from "@mui/material";
import ButtonNavigate from "~/components/ButtonNavigate";
import Path from "~/helpers/Path";

const Navigation = () => {
  return (
    <Box sx={{ display: "flex", gap: 1 }}>
      <ButtonNavigate
        to={Path.home()}
        sx={{ width: "120px", color: "#fff", borderColor: "#fff" }}
      >
        Trang chủ
      </ButtonNavigate>
      <ButtonNavigate
        to={Path.products()}
        sx={{ width: "120px", color: "#fff", borderColor: "#fff" }}
      >
        Sản phẩm
      </ButtonNavigate>
      <ButtonNavigate
        to={Path.introduce("about")}
        sx={{ width: "120px", color: "#fff", borderColor: "#fff" }}
      >
        Giới thiệu
      </ButtonNavigate>
      <ButtonNavigate
        to={Path.contact()}
        sx={{ width: "120px", color: "#fff", borderColor: "#fff" }}
      >
        Liên hệ
      </ButtonNavigate>
    </Box>
  );
};

export default Navigation;
