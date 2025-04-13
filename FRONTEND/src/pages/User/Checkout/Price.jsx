import { Divider, Grid2, Skeleton } from "@mui/material";
import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import ButtonLoading from "~/components/ButtonLoading";
import PaperCustom from "~/components/PaperCustom";
import Format from "~/helpers/Format";
import Path from "~/helpers/Path";

const Price = ({ subTotal, shipping, coupon, handleCheckout }) => {
  const navigate = useNavigate();

  const [discount, setDiscount] = useState(0);
  const shippingFee = shipping.fee ? shipping.fee : 0;

  useEffect(() => {
    if (coupon) {
      if (subTotal >= coupon.minimum_order_value) {
        let calculatedDiscount = 0;

        if (coupon.discount_type === "percentage") {
          calculatedDiscount = (subTotal * coupon.discount_value) / 100;

          if (coupon.maximum_discount) {
            calculatedDiscount = Math.min(
              calculatedDiscount,
              coupon.maximum_discount
            );
          }
        } else if (coupon.discount_type === "fixed") {
          calculatedDiscount = coupon.discount_value;

          if (calculatedDiscount > subTotal) {
            calculatedDiscount = subTotal;
          }
        }

        setDiscount(calculatedDiscount);
      } else {
        setDiscount(0);
      }
    } else {
      setDiscount(0);
    }
  }, [subTotal, coupon, shippingFee]);

  return (
    <PaperCustom sx={{ px: 3, height: "100%" }}>
      <Grid2
        container
        alignItems={"center"}
        spacing={2}
        sx={{ fontSize: "h6.fontSize", py: 2 }}
        fontSize={"body2.fontSize"}
      >
        {!subTotal ? (
          <>
            <Grid2 size={4}>
              <Skeleton height={30} variant="rounded" />
            </Grid2>
            <Grid2 size={8}>
              <Skeleton height={30} width={"50%"} variant="rounded" />
            </Grid2>

            <Grid2 size={4}>
              <Skeleton height={30} variant="rounded" />
            </Grid2>
            <Grid2 size={8}>
              <Skeleton height={30} width={"30%"} variant="rounded" />
            </Grid2>

            <Grid2 size={4}>
              <Skeleton height={30} variant="rounded" />
            </Grid2>
            <Grid2 size={8}>
              <Skeleton height={30} width={"40%"} variant="rounded" />
            </Grid2>

            <Grid2 size={12}>
              <Divider color="#ccc" />
            </Grid2>

            <Grid2 size={4}>
              <Skeleton height={30} variant="rounded" />
            </Grid2>
            <Grid2 size={8}>
              <Skeleton height={36} width={"35%"} variant="rounded" />
            </Grid2>

            <Grid2 container alignItems={"center"} size={12}>
              <Skeleton height={40} width={"20%"} variant="rounded" />
              <Skeleton
                height={40}
                width={"20%"}
                sx={{ ml: 2 }}
                variant="rounded"
              />
            </Grid2>
          </>
        ) : (
          <>
            <Grid2 fontSize={"body2.fontSize"} size={4} fontWeight={"bold"}>
              Tổng tiền sản phẩm:
            </Grid2>
            <Grid2 fontSize={"body2.fontSize"} size={8}>
              {Format.formatCurrency(subTotal)}
            </Grid2>

            <Grid2 fontSize={"body2.fontSize"} size={4} fontWeight={"bold"}>
              Phí vận chuyển:
            </Grid2>
            <Grid2 fontSize={"body2.fontSize"} size={8}>
              {shippingFee > 0
                ? Format.formatCurrency(shippingFee)
                : "Vui lòng chọn dịa chỉ giao hàng"}
            </Grid2>

            <Grid2 fontSize={"body2.fontSize"} size={4} fontWeight={"bold"}>
              Giảm giá:
            </Grid2>
            <Grid2 fontSize={"body2.fontSize"} size={8}>
              {Format.formatCurrency(discount)}
            </Grid2>

            <Grid2 fontSize={"body2.fontSize"} size={12}>
              <Divider color="#ccc" />
            </Grid2>

            <Grid2
              fontSize={"body2.fontSize"}
              size={4}
              sx={{ fontWeight: "bold" }}
            >
              Thành tiền:
            </Grid2>
            <Grid2
              size={8}
              sx={{ fontWeight: "bold", color: "red", fontSize: "h6.fontSize" }}
            >
              {Format.formatCurrency(
                subTotal + parseFloat(shippingFee) - discount
              )}
            </Grid2>

            <Grid2 container size={12} sx={{ height: 40, mt: 2 }} spacing={2}>
              <Grid2 size={6}>
                <ButtonLoading
                  onClick={() => navigate(Path.userCart())}
                  variant="outlined"
                  fullWidth
                >
                  Hủy
                </ButtonLoading>
              </Grid2>

              <Grid2 size={6}>
                <ButtonLoading
                  onClick={handleCheckout}
                  variant="contained"
                  fullWidth
                  disabled={!subTotal || shippingFee === 0}
                >
                  Thanh toán
                </ButtonLoading>
              </Grid2>
            </Grid2>
          </>
        )}
      </Grid2>
    </PaperCustom>
  );
};

export default Price;
