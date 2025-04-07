import { Divider, Grid2, Skeleton } from "@mui/material";
import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import ButtonLoading from "~/components/ButtonLoading";
import PaperCustom from "~/components/PaperCustom";
import Format from "~/helpers/Format";
import Path from "~/helpers/Path";

const Price = ({ subTotal, shippingFee, coupon, handleCheckout, loading }) => {
  const navigate = useNavigate();

  const [discount, setDiscount] = useState(0);
  const shippingFeePrice = shippingFee ? shippingFee.price : 0;

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
    <PaperCustom sx={{ px: 3 }}>
      <Grid2
        container
        alignItems={"center"}
        spacing={2}
        sx={{ fontSize: "h6.fontSize", py: 2 }}
      >
        {!subTotal || !shippingFeePrice ? (
          <>
            <Grid2 size={3}>
              <Skeleton height={30} variant="rounded" />
            </Grid2>
            <Grid2 size={9}>
              <Skeleton height={30} width={"50%"} variant="rounded" />
            </Grid2>

            <Grid2 size={3}>
              <Skeleton height={30} variant="rounded" />
            </Grid2>
            <Grid2 size={9}>
              <Skeleton height={30} width={"30%"} variant="rounded" />
            </Grid2>

            <Grid2 size={3}>
              <Skeleton height={30} variant="rounded" />
            </Grid2>
            <Grid2 size={9}>
              <Skeleton height={30} width={"40%"} variant="rounded" />
            </Grid2>

            <Grid2 size={12}>
              <Divider color="#ccc" />
            </Grid2>

            <Grid2 size={3}>
              <Skeleton height={30} variant="rounded" />
            </Grid2>
            <Grid2 size={9}>
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
            <Grid2 size={3}>Tổng tiền sản phẩm:</Grid2>
            <Grid2 size={9}>{Format.formatCurrency(subTotal)}</Grid2>

            <Grid2 size={3}>Phí vận chuyển:</Grid2>
            <Grid2 size={9}>{Format.formatCurrency(shippingFeePrice)}</Grid2>

            <Grid2 size={3}>Giảm giá:</Grid2>
            <Grid2 size={9}>{Format.formatCurrency(discount)}</Grid2>

            <Grid2 size={12}>
              <Divider color="#ccc" />
            </Grid2>

            <Grid2 size={3} sx={{ fontWeight: "bold" }}>
              Thành tiền:
            </Grid2>
            <Grid2
              size={9}
              sx={{ fontWeight: "bold", color: "red", fontSize: "h5.fontSize" }}
            >
              {Format.formatCurrency(
                subTotal + parseFloat(shippingFeePrice) - discount
              )}
            </Grid2>

            <Grid2
              container
              alignContent={"center"}
              size={12}
              sx={{ height: 40 }}
            >
              <ButtonLoading
                onClick={() => navigate(Path.userCart())}
                loading={loading}
                variant="outlined"
                sx={{ width: "20%" }}
              >
                Hủy
              </ButtonLoading>

              <ButtonLoading
                onClick={handleCheckout}
                loading={loading}
                variant="contained"
                sx={{ width: "20%", ml: 3 }}
              >
                Thanh toán
              </ButtonLoading>
            </Grid2>
          </>
        )}
      </Grid2>
    </PaperCustom>
  );
};

export default Price;
