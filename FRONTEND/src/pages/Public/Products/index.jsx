import { useTheme } from "@emotion/react";
import { Container, Grid2 } from "@mui/material";
import PaperCustom from "~/components/PaperCustom";

const Product = () => {
  const theme = useTheme();
  return (
    <Container maxWidth="xl">
      <Grid2 container spacing={2} columns={10}>
        <Grid2 size={2}>
          <PaperCustom
            sx={{
              display: "flex",
              flexDirection: "column",
              justifyContent: "space-between",
              gap: 2,
              height: `calc(100vh - ${theme.custom.headerHeight} - 2 * ${theme.custom.containerGap})`,
            }}
          >
            ádfasd
          </PaperCustom>
        </Grid2>
        <Grid2 size={8}>
          <PaperCustom sx={{ height: "500px" }}>ádlfj</PaperCustom>
        </Grid2>
      </Grid2>
    </Container>
  );
};

export default Product;
