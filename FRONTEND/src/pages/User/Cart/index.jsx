import React, { useEffect, useState, useCallback } from "react";
import {
  Box,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
  Checkbox,
  Typography,
  Container,
} from "@mui/material";
import axiosWithAuth from "~/utils/axiosWithAuth"; // Đảm bảo đã import axiosWithAuth
import Api from "~/helpers/Api"; // Đảm bảo đã import Api
import { useTheme } from "@emotion/react";
import Path from "~/helpers/Path";
import Format from "~/helpers/Format";

const Cart = () => {
  const theme = useTheme();
  const [carts, setCarts] = useState([]);
  const fetchCarts = useCallback(async () => {
    try {
      const response = await axiosWithAuth.get(Api.cart());
      setCarts(response.data);
    } catch (error) {
      console.error(error.response?.data?.message);
    }
  }, []);

  useEffect(() => {
    fetchCarts();
  }, [fetchCarts]);

  return (
    <Container>
      <Box sx={{ width: "100%", padding: 2 }}>
        {carts?.group?.map((cart, index) => (
          <Box key={index} sx={{ marginBottom: 4 }}>
            <Typography variant="h6" sx={{ marginBottom: 2 }}>
              {cart.store_name}
            </Typography>

            <Box>
              <TableContainer>
                <Table sx={{ borderCollapse: "collapse", border: "none" }}>
                  <TableHead>
                    <TableRow sx={{ backgroundColor: theme.custom?.light }}>
                      <TableCell sx={{ textAlign: "center" }}>Chọn</TableCell>
                      <TableCell sx={{ textAlign: "center" }} width={"40%"}>
                        Sản phẩm
                      </TableCell>
                      <TableCell sx={{ textAlign: "center" }}>
                        Số lượng
                      </TableCell>
                      <TableCell sx={{ textAlign: "center" }}>Giá</TableCell>
                    </TableRow>
                  </TableHead>
                  <TableBody>
                    {cart.cart_details.map((cartDetail) => (
                      <TableRow key={cartDetail.cart_id}>
                        <TableCell align="center">
                          <Checkbox />
                        </TableCell>
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
                            <Typography
                              variant="body2"
                              className="line-clamp-2"
                            >
                              {cartDetail.product.name}
                            </Typography>
                          </Box>
                        </TableCell>
                        <TableCell>{cartDetail.quantity}</TableCell>
                        <TableCell>
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
                            <>
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
                            </>
                          )}
                        </TableCell>
                      </TableRow>
                    ))}
                  </TableBody>
                </Table>
              </TableContainer>
              <Box
                sx={{
                  position: "sticky",
                  bottom: 0,
                  background: "white",
                  p: 2,
                  borderTop: "1px solid #e0e0e0",
                }}
              >
                <Box align="right">Tống giá: 12 VND</Box>
              </Box>
            </Box>
          </Box>
        ))}
      </Box>
    </Container>
  );
};

export default Cart;
