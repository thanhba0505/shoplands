import {
  Grid2,
  Skeleton,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableRow,
  Typography,
} from "@mui/material";
import PaperCustom from "~/components/PaperCustom";

const ProductDetails = ({ productDetails, loading }) => {
  return (
    <PaperCustom sx={{ px: 3 }}>
      {loading ? (
        <>
          <Skeleton height={40} width={400} sx={{ mb: 1.5, my: 1, px: 2 }} />
          <Grid2 container spacing={2} sx={{ pb: 1.5 }}>
            <Grid2 container size={3}>
              <Skeleton height={36} width={400} />
            </Grid2>
            <Grid2 container size={9}>
              <Skeleton height={36} width={700} />
            </Grid2>
            <Grid2 container size={3}>
              <Skeleton height={36} width={400} />
            </Grid2>
            <Grid2 container size={9}>
              <Skeleton height={36} width={500} />
            </Grid2>
            <Grid2 container size={3}>
              <Skeleton height={36} width={400} />
            </Grid2>
            <Grid2 container size={9}>
              <Skeleton height={36} width={600} />
            </Grid2>
          </Grid2>
        </>
      ) : (
        <>
          <Typography
            variant="h6"
            sx={{ mb: 1.5, my: 1, px: 2 }}
            textAlign={"start"}
          >
            Chi tiết sản phẩm
          </Typography>
          <TableContainer sx={{ pb: 1.5 }}>
            <Table>
              <TableBody>
                <TableRow>
                  <TableCell width={"30%"}>
                    <Typography variant="body1" fontWeight={"bold"}>
                      Chi tiết
                    </Typography>
                  </TableCell>
                  <TableCell>
                    <Typography variant="body1" fontWeight={"bold"}>
                      Mô tả
                    </Typography>
                  </TableCell>
                </TableRow>

                {productDetails.map((detail, index) => (
                  <TableRow key={index}>
                    <TableCell width={"30%"}>
                      <Typography variant="body1">{detail.name}</Typography>
                    </TableCell>
                    <TableCell>
                      <Typography variant="body1">
                        {detail.description}
                      </Typography>
                    </TableCell>
                  </TableRow>
                ))}
              </TableBody>
            </Table>
          </TableContainer>
        </>
      )}
    </PaperCustom>
  );
};

export default ProductDetails;
