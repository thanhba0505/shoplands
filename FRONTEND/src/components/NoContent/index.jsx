import { Box, Typography } from "@mui/material";

const NoContent = ({
  text = "Không có nội dung",
  height = 400,
  sx,
  ...props
}) => {
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
      <Typography>{text}</Typography>
    </Box>
  );
};

export default NoContent;
