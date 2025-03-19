import { Box, CircularProgress } from "@mui/material";

const CircularProgressLoading = ({ sx, size, ...props }) => {
  return (
    <Box
      sx={{
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
        height: 400,
        backgroundColor: "transparent",
        ...sx,
      }}
      {...props}
    >
      <CircularProgress size={size} />
    </Box>
  );
};

export default CircularProgressLoading;
