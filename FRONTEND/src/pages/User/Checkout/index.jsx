import { useTheme } from "@emotion/react";
import {
  Box,
  Card,
  CardContent,
  Container,
  FormControl,
  FormControlLabel,
  InputLabel,
  MenuItem,
  Radio,
  RadioGroup,
  Select,
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
import Api from "~/helpers/Api";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import { setSellerId } from "~/redux/orderSlice";
import axiosDefault from "~/utils/axiosDefault";
import axiosWithAuth from "~/utils/axiosWithAuth";

const Address = ({ setAddress }) => {
  const navigate = useNavigate();
  const [addresses, setAddresses] = useState([]);

  const fetchApi = useCallback(async () => {
    try {
      const response = await axiosWithAuth.get(Api.address(), { navigate });
      setAddresses(response.data);
      const defaultAddress = response.data.find((item) => item.default == 1);
      setAddress(defaultAddress);
    } catch (error) {
      Log.error(error.response?.data?.message);
    }
  }, [navigate, setAddress]);

  useEffect(() => {
    fetchApi();
  }, [fetchApi]);

  const handleChangeAddress = (e) => {
    const selectedAddress = addresses.find(
      (item) => item.address_id == e.target.value
    );
    setAddress(selectedAddress); // Lưu đối tượng địa chỉ đầy đủ khi thay đổi
  };

  // Tìm địa chỉ mặc định từ addresses
  const defaultAddress = addresses.find(
    (item) => item.default == 1
  )?.address_id;

  return (
    <Container>
      <Box>
        <Typography variant="h5">Địa chỉ</Typography>

        {defaultAddress && (
          <FormControl>
            <RadioGroup
              aria-labelledby="demo-controlled-radio-buttons-group"
              name="controlled-radio-buttons-group"
              defaultValue={defaultAddress} // Đảm bảo rằng giá trị luôn hợp lệ
              onChange={handleChangeAddress}
            >
              {addresses && addresses.length > 0 ? (
                addresses.map((item) => (
                  <FormControlLabel
                    key={item.address_id}
                    value={item.address_id} // Giá trị của Radio là address_id
                    control={<Radio />}
                    label={
                      <Box py={1}>
                        <Typography variant="body1" sx={{ fontWeight: "bold" }}>
                          {item.province_name}
                        </Typography>
                        {item.address_line}
                        <Typography variant="body2" color="success">
                          {item.default == 1 ? " (Mặc định)" : ""}
                        </Typography>
                      </Box>
                    }
                  />
                ))
              ) : (
                <div>Không có địa chỉ</div>
              )}
            </RadioGroup>
          </FormControl>
        )}
      </Box>
    </Container>
  );
};

const Products = ({ setSubTotal }) => {
  const navigate = useNavigate();
  const cartIds = useSelector((state) => state.order.cart_ids);
  const dispatch = useDispatch();
  const [products, setProducts] = useState([]);

  const theme = useTheme();

  const fetchApi = useCallback(async () => {
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
    }
  }, [navigate, cartIds, dispatch, setSubTotal]);

  useEffect(() => {
    fetchApi();
  }, [fetchApi]);

  return (
    <Container>
      <Typography variant="h5">Sản phẩm</Typography>
      <TableContainer>
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
                  <TableCell align="center">{cartDetail.quantity}</TableCell>

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
    </Container>
  );
};

const Coupons = ({ subTotal, setCoupon, coupon }) => {
  const seller_id = useSelector((state) => state.order.seller_id);
  const [coupons, setCoupons] = useState([]);

  const fetchApi = useCallback(async () => {
    try {
      if (seller_id) {
        const response = await axiosDefault.get(Api.coupons(seller_id));
        setCoupons(response.data);
      }
    } catch (error) {
      Log.error(error.response?.data?.message);
    }
  }, [seller_id]);

  useEffect(() => {
    fetchApi();
  }, [fetchApi]);

  let selectedCoupon = coupon;

  const handleSelectCoupon = (selectedCoupon, minimumOrderValue) => {
    // Kiểm tra xem subTotal có đáp ứng được đơn hàng tối thiểu không
    if (subTotal >= minimumOrderValue) {
      // Toggle selection: Nếu đã chọn thì bỏ chọn, nếu chưa chọn thì chọn
      setCoupon(selectedCoupon === coupon ? null : selectedCoupon);
    }
  };

  return (
    <Container>
      <Typography variant="h5" sx={{ marginBottom: 2 }}>
        Mã Giảm Giá
      </Typography>

      <Box sx={{ maxHeight: "430px", overflowY: "auto" }}>
        <Box display="flex" flexWrap="wrap" gap={2} py={1}>
          {coupons.map((coupon) => (
            <Box
              key={coupon.coupon_id}
              width="calc(33.333% - 16px)"
              marginBottom={2}
              onClick={
                () => handleSelectCoupon(coupon, coupon.minimum_order_value) // Pass full coupon object
              }
              sx={{
                cursor: "pointer",
                border: `1px solid ${
                  coupon === selectedCoupon ? "blue" : "#ccc"
                }`,
                m: 0,
                borderRadius: "8px",
                padding: 1,
                transition: "background-color 0.3s",
                backgroundColor:
                  subTotal < coupon.minimum_order_value
                    ? "#d3d3d3" // Nền xám nếu không đủ điều kiện
                    : coupon === selectedCoupon
                    ? "#f0f8ff" // Nền màu xanh khi chọn
                    : "transparent",
                opacity: subTotal < coupon.minimum_order_value ? 0.5 : 1, // Làm mờ nếu không đủ điều kiện
                pointerEvents:
                  subTotal < coupon.minimum_order_value ? "none" : "",
                "&:hover": {
                  backgroundColor:
                    subTotal < coupon.minimum_order_value
                      ? "#d3d3d3" // Giữ nền xám khi hover nếu không đủ điều kiện
                      : "#f0f8ff", // Giữ nền xanh khi hover nếu chọn
                },
              }}
            >
              <Card
                sx={{
                  backgroundColor: "transparent",
                  border: "none",
                  boxShadow: "none",
                }}
              >
                <CardContent>
                  <Typography variant="h6" sx={{ fontWeight: "bold" }}>
                    {coupon.code}
                  </Typography>
                  <Typography variant="body2" color="text.secondary">
                    {coupon.description}
                  </Typography>
                  <Typography
                    variant="h6"
                    sx={{ marginTop: 1, fontWeight: "bold", color: "red" }}
                  >
                    Giảm:{" "}
                    {coupon.discount_type === "percentage"
                      ? Format.formatPercentage(coupon.discount_value / 100)
                      : Format.formatCurrency(coupon.discount_value)}
                  </Typography>
                  {coupon.maximum_discount && (
                    <Typography variant="body2" color="text.secondary">
                      Giảm tối đa:{" "}
                      {Format.formatCurrency(coupon.maximum_discount)}
                    </Typography>
                  )}
                  <Typography variant="body2" color="text.secondary">
                    Cho đơn hàng tối thiểu:{" "}
                    {coupon.minimum_order_value
                      ? Format.formatCurrency(coupon.minimum_order_value)
                      : "Không yêu cầu"}
                  </Typography>
                  <Typography variant="body2" sx={{ marginTop: 1 }}>
                    Đã sử dụng: {coupon.usage_count}/{coupon.usage_limit}
                  </Typography>
                  <Typography variant="body2" color="text.secondary">
                    Hạn sử dụng: {coupon.start_date} - {coupon.end_date}
                  </Typography>
                </CardContent>
              </Card>
            </Box>
          ))}
        </Box>
      </Box>
    </Container>
  );
};

const ShippingFee = ({ setShippingFee, shippingFee }) => {
  const [shippingFees, setShippingFees] = useState([]);

  const fetchApi = useCallback(async () => {
    try {
      const response = await axiosDefault.get(Api.shippingFees());
      setShippingFees(response.data);

      // Cài phương thức giao hàng mặc định là phương thức đầu tiên trong mảng (nếu có)
      if (response.data && response.data.length > 0) {
        setShippingFee(response.data[0]); // Đặt phương thức giao hàng đầu tiên là mặc định
      }
    } catch (error) {
      Log.error(error.response?.data?.message);
    }
  }, [setShippingFee]);

  useEffect(() => {
    fetchApi();
  }, [fetchApi]);

  const handleChange = (event) => {
    const selectedShippingFee = shippingFees.find(
      (item) => item.shipping_fee_id === event.target.value
    );
    setShippingFee(selectedShippingFee); // Lưu phương thức giao hàng được chọn
  };

  return (
    <Container>
      <Typography variant="h5" sx={{ marginBottom: 2 }}>
        Phương thức giao hàng
      </Typography>

      {shippingFee && (
        <FormControl fullWidth>
          <InputLabel id="shipping-fee-select-label">
            Chọn phương thức giao hàng
          </InputLabel>
          <Select
            labelId="shipping-fee-select-label"
            value={shippingFee.shipping_fee_id} // Đảm bảo rằng giá trị luôn hợp lệ
            onChange={handleChange}
            label="Chọn phương thức giao hàng"
          >
            {shippingFees.map((item) => (
              <MenuItem key={item.shipping_fee_id} value={item.shipping_fee_id}>
                {item.method} - {Format.formatCurrency(item.price)}{" "}
                {/* Hiển thị phương thức và giá */}
              </MenuItem>
            ))}
          </Select>
        </FormControl>
      )}
    </Container>
  );
};

const Price = ({ subTotal, shippingFee, coupon }) => {
  const [discount, setDiscount] = useState(0);
  const shippingFeePrice = shippingFee ? shippingFee.price : 0;

  useEffect(() => {
    if (coupon) {
      // Kiểm tra xem mã giảm giá có đủ điều kiện không
      if (subTotal >= coupon.minimum_order_value) {
        let calculatedDiscount = 0;

        // Tính toán giảm giá theo loại
        if (coupon.discount_type === "percentage") {
          // Giảm giá theo tỷ lệ phần trăm
          calculatedDiscount = (subTotal * coupon.discount_value) / 100;

          // Kiểm tra nếu giảm giá vượt quá mức tối đa
          if (coupon.maximum_discount) {
            calculatedDiscount = Math.min(
              calculatedDiscount,
              coupon.maximum_discount
            );
          }
        } else if (coupon.discount_type === "fixed") {
          // Giảm giá theo giá trị cố định
          calculatedDiscount = coupon.discount_value;

          // Kiểm tra nếu giảm giá vượt quá tổng tiền
          if (calculatedDiscount > subTotal) {
            calculatedDiscount = subTotal;
          }
        }

        // Cập nhật giá trị giảm
        setDiscount(calculatedDiscount);
      } else {
        setDiscount(0); // Nếu không đủ điều kiện, không áp dụng giảm giá
      }
    } else {
      setDiscount(0);
    }
  }, [subTotal, coupon, shippingFee]); // Chạy lại khi `subTotal` hoặc `coupon` thay đổi

  return (
    <Container>
      <Typography variant="h6" sx={{ fontWeight: "bold" }}>
        Tổng tiền sản phẩm: {Format.formatCurrency(subTotal)}
      </Typography>

      <Typography variant="h6" sx={{ fontWeight: "bold" }}>
        Phí vận chuyển: {Format.formatCurrency(shippingFeePrice)}
      </Typography>

      <Typography variant="h6" sx={{ fontWeight: "bold" }}>
        Giảm giá: {Format.formatCurrency(discount)}
      </Typography>

      <Typography variant="h6" sx={{ fontWeight: "bold" }}>
        Thành tiền:{" "}
        {Format.formatCurrency(
          subTotal + parseFloat(shippingFeePrice) - discount
        )}
      </Typography>
    </Container>
  );
};

const Checkout = () => {
  const [address, setAddress] = useState(null);
  const [subTotal, setSubTotal] = useState(0);
  const [coupon, setCoupon] = useState(null);
  const [shippingFee, setShippingFee] = useState(null);
  
  return (
    <>
      <Address setAddress={setAddress} />
      <Products setSubTotal={setSubTotal} />
      <Coupons subTotal={subTotal} setCoupon={setCoupon} coupon={coupon} />
      <ShippingFee setShippingFee={setShippingFee} shippingFee={shippingFee} />

      <Price subTotal={subTotal} shippingFee={shippingFee} coupon={coupon} />
    </>
  );
};

export default Checkout;
