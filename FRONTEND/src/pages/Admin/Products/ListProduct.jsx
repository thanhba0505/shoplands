import { useTheme } from "@emotion/react";
import {
  Avatar,
  Box,
  Button,
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
import { useCallback, useEffect, useRef, useState } from "react";
import { useNavigate } from "react-router-dom";
import NoContent from "~/components/NoContent";
import Api from "~/helpers/Api";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import axiosWithAuth from "~/utils/axiosWithAuth";
import HideImageRoundedIcon from "@mui/icons-material/HideImageRounded";
import { useSnackbar } from "notistack";
import ModalCustom from "~/components/ModalCustom";
import ButtonLoading from "~/components/ButtonLoading";

const BtnAction = ({ product, setProducts }) => {
  const navigate = useNavigate();
  const { enqueueSnackbar } = useSnackbar();

  const [open, setOpen] = useState(false);
  const [loading, setLoading] = useState(false);
  const [message, setMessage] = useState("");

  useEffect(() => {
    if (product) {
      if (product.status === "locked") {
        setMessage("Sản phẩm '" + product.name + "' đã được mở khóa.");
      } else {
        setMessage("Sản phẩm '" + product.name + "' đã bị khóa. Lý do: ");
      }
    }
  }, [product]);

  const handleLocked = useCallback(async () => {
    setLoading(true);
    try {
      const response = await axiosWithAuth.put(
        Api.adminProducts("locked"),
        {
          product_id: product.product_id,
          message,
          locked: product.status === "locked" ? false : true,
        },
        {
          navigate,
        }
      );

      enqueueSnackbar(response.data.message, {
        variant: "success",
      });

      setProducts((prev) => {
        return prev.map((item) => {
          if (item.product_id === product.product_id) {
            return {
              ...item,
              status: product.status === "locked" ? "active" : "locked",
            };
          }
          return item;
        });
      });
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
      setOpen(false);
    }
  }, [product, message, navigate, enqueueSnackbar, setProducts]);

  return (
    <>
      <Button
        sx={{ ml: 1 }}
        variant="outlined"
        color={product.status === "locked" ? "primary" : "error"}
        size="small"
        onClick={() => setOpen(true)}
      >
        {product.status === "locked" ? "Mở khóa" : "Khóa"}
      </Button>

      <ModalCustom
        open={open}
        handleClose={() => setOpen(false)}
        title={
          product.status === "locked" ? "Mở khóa sản phẩm" : "Khóa sản phẩm"
        }
        subtitle={product.name}
        sx={{ width: 700 }}
      >
        <TextField
          sx={{ width: "100%", mt: 1 }}
          fullWidth
          label={
            product.status === "locked"
              ? "Tin nhắn mở khóa sản phẩm"
              : "Lý do khóa sản phẩm"
          }
          multiline
          rows={4}
          variant="outlined"
          value={message}
          onChange={(e) => setMessage(e.target.value)}
        />

        <Box
          sx={{
            display: "flex",
            justifyContent: "center",
            gap: 2,
            mt: 3,
          }}
        >
          <Button
            size="large"
            variant="outlined"
            color="error"
            sx={{ width: "50%" }}
            onClick={() => setOpen(false)}
          >
            Hủy
          </Button>
          <ButtonLoading
            size="large"
            variant="contained"
            sx={{ width: "50%" }}
            onClick={() => {
              handleLocked();
            }}
            loading={loading}
          >
            {product.status === "locked" ? "Mở khóa" : "Khóa sản phẩm"}
          </ButtonLoading>
        </Box>
      </ModalCustom>
    </>
  );
};

const ListProduct = ({ status, loading, setLoading }) => {
  const navigate = useNavigate();
  const theme = useTheme();

  const searchRef = useRef("");
  const [search, setSearch] = useState("");

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
        const response = await axiosWithAuth.get(Api.products(), {
          params: {
            limit: limit,
            page: page,
            status: status,
            search: searchRef.current,
          },
          navigate,
        });

        setProducts(response.data.products);
        setCount(response.data.count);
      } catch (error) {
        Log.error(error.response?.data?.message);
      } finally {
        setLoading(false);
      }
    },
    [status, setLoading, navigate]
  );

  useEffect(() => {
    fetchApi(page, rowsPerPage);
  }, [page, rowsPerPage, status, fetchApi]);

  return (
    <>
      <Box
        sx={{
          display: "flex",
          justifyContent: "start",
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
          value={search}
          onChange={(e) => {
            setSearch(e.target.value);
            searchRef.current = e.target.value; // 🔥 cập nhật vào ref
          }}
          onKeyDown={(e) => e.key === "Enter" && fetchApi(page, rowsPerPage)}
          sx={{ width: 500 }}
        />

        <Box sx={{ mr: "auto" }}>
          <Button
            variant="contained"
            onClick={async () => await fetchApi(page, rowsPerPage)}
          >
            Tìm kiếm
          </Button>
        </Box>

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
              <TableCell align="center">Trạng thái</TableCell>
              <TableCell align="center">Hành động</TableCell>
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
                    <TableRow hover key={product.product_id}>
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
                        {Format.formatStatus(product.status)}
                      </TableCell>
                      <TableCell align="center">
                        <BtnAction
                          product={product}
                          setProducts={setProducts}
                        />
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
