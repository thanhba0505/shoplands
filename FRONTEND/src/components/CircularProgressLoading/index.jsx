import { Box, CircularProgress } from "@mui/material";

const CircularProgressLoading = ({ sx, height = 400, size, ...props }) => {
  return (
    <Box
      sx={{
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
        height: height,
        backgroundColor: "transparent",
        ...sx,
      }}
      {...props}
    >
      <CircularProgress size={size} color="primary" />
    </Box>
  );
};

export default CircularProgressLoading;
