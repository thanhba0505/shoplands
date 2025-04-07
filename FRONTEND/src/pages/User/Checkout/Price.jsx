import { Container, Typography } from "@mui/material";
import { useEffect, useState } from "react";
import Format from "~/helpers/Format";

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

export default Price;
