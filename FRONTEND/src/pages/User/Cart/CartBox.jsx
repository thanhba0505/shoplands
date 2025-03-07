import { useState, useEffect, useCallback } from "react";
import {
  Box,
  Button,
  Checkbox,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
  Typography,
} from "@mui/material";
import QuantityInput from "~/components/QuantityInput";
import Format from "~/helpers/Format";
import Path from "~/helpers/Path";
import { useTheme } from "@emotion/react";
import axiosWithAuth from "~/utils/axiosWithAuth";
import Api from "~/helpers/Api";
import { useNavigate } from "react-router-dom";

const CartBox = ({ cart }) => {
  const navigate = useNavigate();
  const theme = useTheme();
  const [selectedItems, setSelectedItems] = useState([]);
  const [totalAmount, setTotalAmount] = useState(0);
  const [cartDetails, setCartDetails] = useState(cart.cart_details);

  // Tính tổng tiền
  const calculateTotal = useCallback(() => {
    let total = 0;
    cartDetails.forEach((cartDetail) => {
      if (selectedItems.includes(cartDetail.cart_id)) {
        const price =
          cartDetail.product_variant.promotion_price ||
          cartDetail.product_variant.price;
        total += (parseFloat(price) || 0) * cartDetail.quantity;
      }
    });
    setTotalAmount(total);
  }, [selectedItems, cartDetails]);

  useEffect(() => {
    calculateTotal();
  }, [calculateTotal]);

  // Xử lý checkbox chọn sản phẩm
  const handleChangeCheckbox = (event, cartId) => {
    let newSelectedItems;
    if (event.target.checked) {
      newSelectedItems = [...selectedItems, cartId];
    } else {
      newSelectedItems = selectedItems.filter((id) => id !== cartId);
    }
    setSelectedItems(newSelectedItems);
  };

  // Xử lý thay đổi số lượng
  const handleChangeQuantity = async (cartId, newQuantity) => {
    // Cập nhật giỏ hàng ngay lập tức trước khi gọi API
    const updatedCartDetails = cartDetails.map((cartDetail) => {
      if (cartDetail.cart_id === cartId) {
        return { ...cartDetail, quantity: newQuantity };
      }
      return cartDetail;
    });
    setCartDetails(updatedCartDetails);

    try {
      // Gọi API để thay đổi số lượng trên server
      const cartDetailToUpdate = updatedCartDetails.find(
        (cartDetail) => cartDetail.cart_id === cartId
      );

      const response = await axiosWithAuth.put(
        Api.cart(),
        {
          product_variant_id:
            cartDetailToUpdate.product_variant.product_variant_id,
          quantity: newQuantity,
        },
        { navigate }
      );

      // Kiểm tra thành công và cập nhật lại giỏ hàng
      if (response.status === 200 || response.status === 201) {
        setCartDetails((prevCartDetails) =>
          prevCartDetails.map((cartDetail) =>
            cartDetail.cart_id === cartId
              ? { ...cartDetail, quantity: newQuantity }
              : cartDetail
          )
        );
      }
    } catch (error) {
      window.location.reload();
    }
  };

  const handleCheckout = () => {
    const selectedProducts = cartDetails.filter((cartDetail) =>
      selectedItems.includes(cartDetail.cart_id)
    );

    const selectedItemsWithQuantity = selectedProducts.map((product) => ({
      cart_id: product.cart_id,
      quantity: product.quantity,
    }));

    console.log("Sản phẩm đã chọn và số lượng:", selectedItemsWithQuantity);
  };

  return (
    <>
      <Typography variant="h6" sx={{ marginBottom: 2 }}>
        {cart.store_name}
      </Typography>

      <Box>
        <TableContainer>
          <Table sx={{ borderCollapse: "collapse", border: "none" }}>
            <TableHead>
              <TableRow sx={{ backgroundColor: theme.custom?.primary.light }}>
                <TableCell sx={{ textAlign: "center" }}>Chọn</TableCell>
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
              {cartDetails.map((cartDetail) => (
                <TableRow key={cartDetail.cart_id}>
                  <TableCell align="center">
                    <Checkbox
                      checked={selectedItems.includes(cartDetail.cart_id)}
                      onChange={(event) =>
                        handleChangeCheckbox(event, cartDetail.cart_id)
                      }
                    />
                  </TableCell>

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
                      cartDetail.variant_value.map((variantValue, index) => (
                        <Typography key={index}>
                          {variantValue.name}: {variantValue.value}
                        </Typography>
                      ))}
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
                    <QuantityInput
                      min={1}
                      max={cartDetail.product_variant.quantity}
                      value={cartDetail.quantity}
                      onChange={(newQuantity) =>
                        handleChangeQuantity(cartDetail.cart_id, newQuantity)
                      }
                    />
                  </TableCell>

                  {/* Thành tiền */}
                  <TableCell align="center">
                    {selectedItems.includes(cartDetail.cart_id)
                      ? Format.formatCurrency(
                          (parseFloat(
                            cartDetail.product_variant.promotion_price ||
                              cartDetail.product_variant.price
                          ) || 1) * cartDetail.quantity
                        )
                      : "0"}
                  </TableCell>
                </TableRow>
              ))}
            </TableBody>
          </Table>
        </TableContainer>

        {/* Footer */}
        <Box
          sx={{
            position: "sticky",
            bottom: 0,
            background: "white",
            pt: 2,
            pb: 4,
            borderTop: "1px solid #e0e0e0",
            display: "flex",
            justifyContent: "space-between",
          }}
        >
          <Typography variant="body1">
            Đã chọn: {selectedItems.length}
          </Typography>
          <Typography variant="h6" color="error" fontWeight="bold">
            Tổng tiền: {Format.formatCurrency(totalAmount)}
          </Typography>
          <Button variant="contained" onClick={handleCheckout}>
            Thanh toán
          </Button>
        </Box>
      </Box>
    </>
  );
};

export default CartBox;
