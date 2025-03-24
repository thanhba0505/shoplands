import { Box, Typography } from "@mui/material";
import { useTheme } from "@mui/material/styles";
import Path from "~/helpers/Path";

const Logo = () => {
  const theme = useTheme();

  return (
    <Box sx={{ display: "flex", alignItems: "center" }}>
      <Box sx={{ height: "" }}>
        <img style={{ display: "block" }} src={Path.publicLogoRectangle()} alt="logo" />
      </Box>
    </Box>
  );
};

export default Logo;
