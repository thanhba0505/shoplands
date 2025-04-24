import { useTheme } from "@emotion/react";
import {
  Avatar,
  Box,
  Rating,
  Skeleton,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TablePagination,
  TableRow,
  TextField,
  Typography,
} from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import { useSelector } from "react-redux";
import { useNavigate } from "react-router-dom";
import NoContent from "~/components/NoContent";
import Api from "~/helpers/Api";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import axiosWithAuth from "~/utils/axiosWithAuth";
import HideImageRoundedIcon from "@mui/icons-material/HideImageRounded";

const ListProduct = ({ status, loading, setLoading }) => {
  const seller_id = useSelector((state) => state.auth?.account?.seller_id);
  const navigate = useNavigate();
  const theme = useTheme();

  const [products, setProducts] = useState([]);
  const [count, setCount] = useState(0);
  const [page, setPage] = useState(0);
  const [rowsPerPage, setRowsPerPage] = useState(10);

  const handleChangePage = (event, newPage) => {
    setPage(newPage);
    fetchApi(newPage, rowsPerPage);
  };

  const handleChangeRowsPerPage = (event) => {
    const newRowsPerPage = parseInt(event.target.value, 10);
    setRowsPerPage(newRowsPerPage);
    setPage(0);
    fetchApi(0, newRowsPerPage);
  };

  const fetchApi = useCallback(
    async (page = 0, limit = 10) => {
      setLoading(true);
      try {
        if (seller_id) {
          const response = await axiosWithAuth.get(Api.products(), {
            params: {
              limit: limit,
              page: page,
              status: status,
              seller_id: seller_id,
            },
            navigate,
          });

          setProducts(response.data.products);
          setCount(response.data.count);
        }
      } catch (error) {
        Log.error(error.response?.data?.message);
      } finally {
        setLoading(false);
      }
    },
    [seller_id, status, setLoading, navigate]
  );

  useEffect(() => {
    fetchApi(page, rowsPerPage);
  }, [seller_id, page, rowsPerPage, status, fetchApi]);

  return (
    <>
      <Box
        sx={{
          display: "flex",
          justifyContent: "space-between",
          gap: 2,
          alignItems: "center",
          py: 2,
        }}
      >
        <TextField
          size="small"
          label="Tìm kiếm sản phẩm"
          autoComplete="off"
          variant="outlined"
          sx={{ width: 500 }}
        />

        <TablePagination
          disabled={loading}
          component="div"
          count={count}
          page={page}
          onPageChange={handleChangePage}
          rowsPerPage={rowsPerPage}
          onRowsPerPageChange={handleChangeRowsPerPage}
          labelRowsPerPage="Số dòng mỗi trang"
          labelDisplayedRows={({ from, to, count }) =>
            `${from}-${to} trên ${count}`
          }
        />
      </Box>

      <TableContainer sx={{ borderRadius: 1 }}>
        <Table>
          <TableHead>
            <TableRow sx={{ backgroundColor: theme.custom?.primary.light }}>
              <TableCell align="left" width={300}>
                Sản phẩm
              </TableCell>
              <TableCell align="center">Giá</TableCell>
              <TableCell align="center">Danh mục</TableCell>
              <TableCell align="center">Đánh giá</TableCell>
              <TableCell align="center">Tồn kho</TableCell>
              <TableCell align="center">Đã bán</TableCell>
            </TableRow>
          </TableHead>
          <TableBody>
            {loading ? (
              <>
                <TableRow>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                </TableRow>

                <TableRow>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                </TableRow>

                <TableRow>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                </TableRow>
              </>
            ) : (
              <>
                {products && products.length > 0 ? (
                  products.map((product) => (
                    <TableRow
                      hover
                      sx={{ cursor: "pointer" }}
                      key={product.product_id}
                      onClick={() =>
                        navigate(Path.sellerProductDetail(product.product_id))
                      }
                    >
                      <TableCell>
                        <Box
                          sx={{ display: "flex", alignItems: "center", gap: 2 }}
                        >
                          <Avatar
                            alt={product.name}
                            variant="square"
                            src={Path.publicProduct(product.image_path)}
                            sx={{ width: 50, height: 50 }}
                          >
                            {<HideImageRoundedIcon fontSize="large" />}
                          </Avatar>
                          <Typography className="line-clamp-2" variant="body2">
                            {product.name}
                          </Typography>
                        </Box>
                      </TableCell>
                      <TableCell align="center">
                        <Typography
                          color="error"
                          variant="body2"
                          fontWeight="bold"
                        >
                          {product.min_price === product.max_price
                            ? Format.formatCurrency(product.min_price)
                            : `${Format.formatCurrency(
                                product.min_price
                              )} - ${Format.formatCurrency(product.max_price)}`}
                        </Typography>
                      </TableCell>
                      <TableCell align="center">
                        {product.category_name}
                      </TableCell>
                      <TableCell align="center">
                        <Rating
                          size="small"
                          name="read-only"
                          readOnly
                          value={
                            product.average_rating
                              ? parseFloat(product.average_rating)
                              : 0
                          }
                          precision={0.1}
                        />
                      </TableCell>
                      <TableCell align="center">
                        {product.quantity || 0}
                      </TableCell>
                      <TableCell align="center">
                        {product.sold_quantity || 0}
                      </TableCell>
                    </TableRow>
                  ))
                ) : (
                  <TableRow>
                    <TableCell colSpan={7}>
                      <NoContent height={300} text="Không có sản phẩm nào" />
                    </TableCell>
                  </TableRow>
                )}
              </>
            )}
          </TableBody>
        </Table>
      </TableContainer>

      <TablePagination
        disabled={loading}
        component="div"
        count={count}
        page={page}
        onPageChange={handleChangePage}
        rowsPerPage={rowsPerPage}
        onRowsPerPageChange={handleChangeRowsPerPage}
        labelRowsPerPage="Số dòng mỗi trang"
        labelDisplayedRows={({ from, to, count }) =>
          `${from}-${to} trên ${count}`
        }
      />
    </>
  );
};

export default ListProduct;
