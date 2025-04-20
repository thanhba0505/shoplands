import { Box } from "@mui/material";
import { useNavigate } from "react-router-dom";
import Path from "~/helpers/Path";

const Logo = () => {
  const navigate = useNavigate();

  return (
    <Box
      sx={{ height: "100%", cursor: "pointer" }}
      onClick={() => navigate(Path.home())}
    >
      <img
        style={{
          display: "block",
          objectFit: "cover",
          height: "100%",
          width: "200px",
        }}
        src={Path.publicLogo1()}
        alt="logo"
      />
    </Box>
  );
};

export default Logo;
