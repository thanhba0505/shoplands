import { useTheme } from "@emotion/react";
import {
  Box,
  Grid2,
  Skeleton,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
  Typography,
} from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import { useNavigate } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import { setSellerId } from "~/redux/orderSlice";
import axiosWithAuth from "~/utils/axiosWithAuth";

const Products = ({ setSubTotal }) => {
  const navigate = useNavigate();
  const cartIds = useSelector((state) => state.order.cart_ids);
  const dispatch = useDispatch();

  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);

  const theme = useTheme();

  const fetchApi = useCallback(async () => {
    setLoading(true);
    try {
      const response = await axiosWithAuth.post(
        Api.cart("ids"),
        {
          cart_ids: cartIds,
        },
        { navigate }
      );
      dispatch(setSellerId(response.data.group.seller_id));
      setProducts(response.data.group.cart_details);

      let subTotal = 0;
      response.data.group.cart_details.forEach((item) => {
        subTotal +=
          (item.product_variant.promotion_price || item.product_variant.price) *
          item.quantity;
      });
      setSubTotal(subTotal);
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  }, [navigate, cartIds, dispatch, setSubTotal]);

  useEffect(() => {
    fetchApi();
  }, [fetchApi, cartIds]);

  return (
    <PaperCustom sx={{ px: 3 }}>
      {loading ? (
        <>
          <Skeleton height={40} width={400} sx={{ mb: 1.5, my: 1, px: 2 }} />
          <Grid2 container spacing={2} sx={{ pb: 1.5 }} columns={12}>
            <Grid2 container size={4}>
              <Skeleton height={36} width={"100%"} />
            </Grid2>
            <Grid2 container size={2}>
              <Skeleton height={36} width={"100%"} />
            </Grid2>
            <Grid2 container size={2}>
              <Skeleton height={36} width={"100%"} />
            </Grid2>
            <Grid2 container size={2}>
              <Skeleton height={36} width={"100%"} />
            </Grid2>
            <Grid2 container size={2}>
              <Skeleton height={36} width={"100%"} />
            </Grid2>
            <Grid2 container size={4}>
              <Skeleton height={36} width={"100%"} />
            </Grid2>
            <Grid2 container size={2}>
              <Skeleton height={36} width={"100%"} />
            </Grid2>
            <Grid2 container size={2}>
              <Skeleton height={36} width={"100%"} />
            </Grid2>
            <Grid2 container size={2}>
              <Skeleton height={36} width={"100%"} />
            </Grid2>
            <Grid2 container size={2}>
              <Skeleton height={36} width={"100%"} />
            </Grid2>
            <Grid2 container size={4}>
              <Skeleton height={36} width={"100%"} />
            </Grid2>
            <Grid2 container size={2}>
              <Skeleton height={36} width={"100%"} />
            </Grid2>
            <Grid2 container size={2}>
              <Skeleton height={36} width={"100%"} />
            </Grid2>
            <Grid2 container size={2}>
              <Skeleton height={36} width={"100%"} />
            </Grid2>
            <Grid2 container size={2}>
              <Skeleton height={36} width={"100%"} />
            </Grid2>
          </Grid2>
        </>
      ) : (
        <>
          <Typography variant="h6">Sản phẩm</Typography>
          <TableContainer sx={{ py: 2 }}>
            <Table sx={{ borderCollapse: "collapse", border: "none" }}>
              <TableHead>
                <TableRow sx={{ backgroundColor: theme.custom?.primary.light }}>
                  <TableCell sx={{ textAlign: "center" }} width={"40%"}>
                    Sản phẩm
                  </TableCell>
                  <TableCell sx={{ textAlign: "center" }}>Phân loại</TableCell>
                  <TableCell sx={{ textAlign: "center" }}>Giá</TableCell>
                  <TableCell sx={{ textAlign: "center" }}>Số lượng</TableCell>
                  <TableCell sx={{ textAlign: "center" }}>Thành tiền</TableCell>
                </TableRow>
              </TableHead>
              <TableBody>
                {products &&
                  products.map((cartDetail) => (
                    <TableRow key={cartDetail.cart_id}>
                      {/* Sản phẩm */}
                      <TableCell>
                        <Box
                          sx={{
                            display: "flex",
                            alignItems: "center",
                            gap: 2,
                          }}
                        >
                          <img
                            src={Path.publicProduct(cartDetail.image)}
                            alt={cartDetail.product.name}
                            style={{ width: "50px", height: "50px" }}
                          />
                          <Typography variant="body2" className="line-clamp-2">
                            {cartDetail.product.name}
                          </Typography>
                        </Box>
                      </TableCell>

                      {/* Phân loại */}
                      <TableCell align="center">
                        {cartDetail.variant_value &&
                          cartDetail.variant_value.map(
                            (variantValue, index) => (
                              <Typography key={index}>
                                {variantValue.name}: {variantValue.value}
                              </Typography>
                            )
                          )}
                      </TableCell>

                      {/* Đơn giá */}
                      <TableCell align="center">
                        {cartDetail.product_variant.promotion_price ? (
                          <>
                            <Typography
                              variant="subtitle2"
                              sx={{
                                display: "inline",
                                textDecoration: "line-through",
                              }}
                            >
                              {Format.formatCurrency(
                                cartDetail.product_variant.price
                              )}
                            </Typography>
                            <br />
                            <Typography
                              variant="body1"
                              color="error"
                              fontWeight="bold"
                              sx={{ display: "inline" }}
                            >
                              {Format.formatCurrency(
                                cartDetail.product_variant.promotion_price
                              )}
                            </Typography>
                          </>
                        ) : (
                          <Typography
                            variant="body2"
                            color="error"
                            fontWeight="bold"
                            sx={{ display: "inline" }}
                          >
                            {Format.formatCurrency(
                              cartDetail.product_variant.price
                            )}
                          </Typography>
                        )}
                      </TableCell>

                      {/* Số lượng */}
                      <TableCell align="center">
                        {cartDetail.quantity}
                      </TableCell>

                      {/* Thành tiền */}
                      <TableCell align="center">
                        {Format.formatCurrency(
                          (parseFloat(
                            cartDetail.product_variant.promotion_price ||
                              cartDetail.product_variant.price
                          ) || 1) * cartDetail.quantity
                        )}
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

export default Products;
