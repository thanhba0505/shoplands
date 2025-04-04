import { Box, Grid2, Skeleton } from "@mui/material";

const SkeletonProducts = ({ count, columns = 12, size = 2, sx }) => {
  return (
    <Grid2
      container
      columnSpacing={2}
      rowSpacing={3}
      columns={columns}
      sx={{ ...sx }}
    >
      {Array.from({ length: count }).map((_, index) => (
        <Grid2 key={index} size={size}>
          <Box
            display="flex"
            flexDirection="column"
            justifyContent="start"
            gap={1}
            sx={{ borderRadius: 2 }}
            overflow="hidden"
            height="360px"
            pb={2}
          >
            <Skeleton animation="pulse" variant="rectangular" height={200} />
            <Box>
              <Skeleton animation="pulse" variant="text" />
              <Skeleton animation="pulse" variant="text" />
            </Box>
            <Skeleton animation="pulse" variant="text" width={"50%"} sx={{ fontSize: "2rem" }}  />
            <Box>
              <Skeleton animation="pulse" variant="text" width={"70%"} />
              <Skeleton animation="pulse" variant="text" />
            </Box>
          </Box>
        </Grid2>
      ))}
    </Grid2>
  );
};

export default SkeletonProducts;
