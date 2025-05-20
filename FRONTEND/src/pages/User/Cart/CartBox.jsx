import { useState, useEffect, useCallback } from "react";
import {
  Box,
  Button,
  Checkbox,
  IconButton,
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
import { useDispatch } from "react-redux";
import { setCartIds } from "~/redux/orderSlice";
import { useSnackbar } from "notistack";
import PaperCustom from "~/components/PaperCustom";
import DeleteForeverRoundedIcon from "@mui/icons-material/DeleteForeverRounded";
import Log from "~/helpers/Log";
import ConfirmModal from "~/components/ConfirmModal";

const DeleteCart = ({ handleDelete, loading }) => {
  const [open, setOpen] = useState(false);

  return (
    <>
      <IconButton onClick={() => setOpen(true)} color="error">
        <DeleteForeverRoundedIcon />
      </IconButton>

      <ConfirmModal
        modelTitle="Xác nhận xóa"
        acceptTitle="Xóa"
        open={open}
        setOpen={setOpen}
        loading={loading}
        handleAccept={() => handleDelete()}
      />
    </>
  );
};

const CartBox = ({ cart, handleUpdateCartSeller }) => {
  const navigate = useNavigate();
  const dispatch = useDispatch();
  const theme = useTheme();
  const { enqueueSnackbar } = useSnackbar();
  const [selectedItems, setSelectedItems] = useState([]);
  const [totalAmount, setTotalAmount] = useState(0);
  const [cartDetails, setCartDetails] = useState([]);

  const [loadingDelete, setLoadingDelete] = useState(false);

  // Khởi tạo dữ liệu với mặc định quantity = 1 nếu null
  useEffect(() => {
    if (cart?.cart_details) {
      const initializedCartDetails = cart.cart_details.map((detail) => ({
        ...detail,
        // API trả về cart_quantity thay vì quantity
        quantity: detail.cart_quantity === null ? 1 : detail.cart_quantity,
      }));
      setCartDetails(initializedCartDetails);
    }
  }, [cart]);

  // Tính tổng tiền
  const calculateTotal = useCallback(() => {
    let total = 0;
    cartDetails.forEach((cartDetail) => {
      if (selectedItems.includes(cartDetail.cart_id)) {
        const price = cartDetail.promotion_price || cartDetail.price;
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
    try {
      // Cập nhật giao diện người dùng trước
      setCartDetails((prevCartDetails) =>
        prevCartDetails.map((item) =>
          item.cart_id === cartId ? { ...item, quantity: newQuantity } : item
        )
      );

      // Tìm chi tiết giỏ hàng được cập nhật
      const cartDetail = cartDetails.find((item) => item.cart_id === cartId);

      // Gọi API để cập nhật số lượng
      await axiosWithAuth.put(
        Api.cart(),
        {
          product_variant_id: cartDetail.product_variant_id,
          quantity: newQuantity,
        },
        { navigate }
      );
    } catch (error) {
      Log.error(error.response?.data?.message);
      setCartDetails((prevState) => [...prevState]);
    }
  };

  const handleCheckout = () => {
    const selectedProducts = cartDetails.filter((cartDetail) =>
      selectedItems.includes(cartDetail.cart_id)
    );

    const selectedItemsWithQuantity = selectedProducts.map(
      (product) => product.cart_id
    );

    if (selectedItemsWithQuantity.length > 0) {
      dispatch(setCartIds(selectedItemsWithQuantity));
      navigate(Path.userOrders("checkout"));
    } else {
      enqueueSnackbar("Chưa chọn sản phẩm nào", {
        variant: "error",
      });
    }
  };

  const handleDelete = async (cart_id) => {
    setLoadingDelete(true);
    try {
      await axiosWithAuth.delete(
        Api.cart(),
        { data: { cart_id } },
        { navigate }
      );
      enqueueSnackbar("Xóa thành công", { variant: "success" });

      const updatedCartDetails = cartDetails.filter(
        (item) => item.cart_id !== cart_id
      );
      setCartDetails(updatedCartDetails);

      if (updatedCartDetails.length === 0) {
        handleUpdateCartSeller(cart.seller_id);
      }
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoadingDelete(false);
    }
  };

  return (
    <>
      {cartDetails.length > 0 && (
        <PaperCustom sx={{ px: 3 }}>
          <Typography
            variant="body1"
            fontWeight={"bold"}
            sx={{ marginBottom: 2, mt: 1, cursor: "pointer" }}
            onClick={() => navigate(Path.shop(cart.seller_id))}
          >
            {cart.store_name}{" "}
            {cart.account_status === "locked" && <>(Cửa hàng đã bị khóa)</>}
          </Typography>

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
                  <TableCell sx={{ textAlign: "center" }}>Xóa</TableCell>
                </TableRow>
              </TableHead>
              <TableBody>
                {cartDetails.map((cartDetail) => (
                  <TableRow hover key={cartDetail.cart_id}>
                    <TableCell align="center">
                      <Checkbox
                        checked={selectedItems.includes(cartDetail.cart_id)}
                        onChange={(event) =>
                          handleChangeCheckbox(event, cartDetail.cart_id)
                        }
                        disabled={
                          cartDetail.status === "active" &&
                          cart.account_status === "active"
                            ? false
                            : true
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
                          cursor: "pointer",
                          "&:hover": {
                            color: theme.palette.primary.dark,
                          },
                        }}
                        onClick={() =>
                          navigate(Path.productDetail(cartDetail.product_id))
                        }
                      >
                        <img
                          src={Path.publicProduct(cartDetail.image)}
                          alt={cartDetail.product_name}
                          style={{ width: "50px", height: "50px" }}
                        />
                        <Typography variant="body2" className="line-clamp-2">
                          {cartDetail.product_name}
                        </Typography>
                      </Box>
                    </TableCell>

                    {/* Phân loại */}
                    <TableCell align="center">
                      {cartDetail.variant_value &&
                        cartDetail.variant_value.map((variantValue, index) => (
                          <Typography key={index}>
                            {variantValue.attribute_name}:{" "}
                            {variantValue.attribute_value}
                          </Typography>
                        ))}
                    </TableCell>

                    {/* Đơn giá */}
                    <TableCell align="center">
                      {cartDetail.promotion_price ? (
                        <>
                          <Typography
                            variant="subtitle2"
                            sx={{
                              display: "inline",
                              textDecoration: "line-through",
                            }}
                          >
                            {Format.formatCurrency(cartDetail.price)}
                          </Typography>
                          <br />
                          <Typography
                            variant="body1"
                            color="error"
                            fontWeight="bold"
                            sx={{ display: "inline" }}
                          >
                            {Format.formatCurrency(cartDetail.promotion_price)}
                          </Typography>
                        </>
                      ) : (
                        <Typography
                          variant="body2"
                          color="error"
                          fontWeight="bold"
                          sx={{ display: "inline" }}
                        >
                          {Format.formatCurrency(cartDetail.price)}
                        </Typography>
                      )}
                    </TableCell>

                    {cart.account_status === "locked" ? (
                      <TableCell colSpan={2} align="center">
                        <Typography variant="body2" color="error">
                          Cửa hàng đã bị khóa
                        </Typography>
                      </TableCell>
                    ) : (
                      <>
                        {cartDetail.status === "active" ? (
                          <>
                            {/* Số lượng */}
                            <TableCell align="center">
                              <QuantityInput
                                min={1}
                                max={cartDetail.product_quantity}
                                value={cartDetail.quantity}
                                onChange={(newQuantity) =>
                                  handleChangeQuantity(
                                    cartDetail.cart_id,
                                    newQuantity
                                  )
                                }
                              />
                            </TableCell>

                            {/* Thành tiền */}
                            <TableCell align="center">
                              {selectedItems.includes(cartDetail.cart_id)
                                ? Format.formatCurrency(
                                    (parseFloat(
                                      cartDetail.promotion_price ||
                                        cartDetail.price
                                    ) || 0) * cartDetail.quantity
                                  )
                                : "0"}
                            </TableCell>
                          </>
                        ) : (
                          <TableCell colSpan={2} align="center">
                            <Typography variant="body2" color="error">
                              <>
                                {cartDetail.status === "locked" &&
                                  "Sản phẩm đã bị khóa"}
                                {cartDetail.status === "deleted" &&
                                  "Sản phẩm đã bị xóa"}
                              </>
                            </Typography>
                          </TableCell>
                        )}
                      </>
                    )}

                    {/* Xóa */}
                    <TableCell align="center">
                      <DeleteCart
                        handleDelete={() => handleDelete(cartDetail.cart_id)}
                        loading={loadingDelete}
                      />
                    </TableCell>
                  </TableRow>
                ))}
              </TableBody>
            </Table>
          </TableContainer>

          {/* Footer */}
          <Box
            sx={{
              background: "white",
              pt: 3,
              pb: 2,
              borderTop: "1px solid #e0e0e0",
              display: "flex",
              alignItems: "center",
              justifyContent: "space-between",
            }}
          >
            <Typography variant="body1" lineHeight={1}>
              Đã chọn: {selectedItems.length}
            </Typography>
            <Typography
              variant="h6"
              color="error"
              fontWeight="bold"
              lineHeight={1}
            >
              Tổng tiền: {Format.formatCurrency(totalAmount)}
            </Typography>
            <Button
              disabled={cart.account_status === "locked"}
              variant="contained"
              sx={{ px: 4 }}
              onClick={handleCheckout}
            >
              Mua hàng
            </Button>
          </Box>
        </PaperCustom>
      )}
    </>
  );
};

export default CartBox;
