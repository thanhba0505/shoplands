import { Box, Typography } from "@mui/material";

const NoContent = ({ text = "Không có nội dung", sx, ...props }) => {
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
      <Typography>{text}</Typography>
    </Box>
  );
};

export default NoContent;
