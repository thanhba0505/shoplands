import { Box, Typography } from "@mui/material";

const NoContent = ({ sx, ...props }) => {
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
      <Typography>Không có nội dung</Typography>
    </Box>
  );
};

export default NoContent;
