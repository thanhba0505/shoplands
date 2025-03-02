import { Button } from "@mui/material";
import { useNavigate } from "react-router-dom";
import Url from "~/helpers/Url";

const ButtonNavigate = ({ to, children, ...props }) => {
    const navigate = useNavigate();

    return (
        <Button
            variant={Url.getCurrentPath() === to ? "outlined" : "text"} // 🔥 Tự động đổi variant nếu đang ở trang đó
            onClick={() => navigate(to)}
            sx={{ width: "120px" }}
            {...props}
        >
            {children}
        </Button>
    );
};

export default ButtonNavigate;
