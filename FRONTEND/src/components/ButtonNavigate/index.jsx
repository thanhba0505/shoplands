import { Button } from "@mui/material";
import { useNavigate, useLocation } from "react-router-dom";

const ButtonNavigate = ({ to, children, ...props }) => {
    const navigate = useNavigate();
    const location = useLocation(); // Lấy path hiện tại

    return (
        <Button
            variant={location.pathname === to ? "outlined" : "text"} // 🔥 Tự động đổi variant nếu đang ở trang đó
            onClick={() => navigate(to)}
            sx={{ width: "120px" }}
            {...props}
        >
            {children}
        </Button>
    );
};

export default ButtonNavigate;
