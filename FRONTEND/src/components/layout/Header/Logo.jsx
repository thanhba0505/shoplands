import { Box } from "@mui/material";
import Path from "~/helpers/Path";

const Logo = () => {
  return (
    <Box sx={{ display: "flex", alignItems: "center" }}>
      <Box sx={{ height: "" }}>
        <img style={{ display: "block" }} src={Path.publicLogoRectangle()} alt="logo" />
      </Box>
    </Box>
  );
};

export default Logo;
