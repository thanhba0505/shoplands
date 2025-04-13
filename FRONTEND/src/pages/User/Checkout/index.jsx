import { Container, Grid2 } from "@mui/material";
import { useEffect, useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import { useNavigate } from "react-router-dom";
import Api from "~/helpers/Api";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import { startLoading, stopLoading } from "~/redux/loadingSlice";
import axiosWithAuth from "~/utils/axiosWithAuth";
import Address from "./Address";
import Products from "./Products";
import Coupons from "./Coupons";
import ShippingFee from "./ShippingFee";
import Price from "./Price";

const Checkout = () => {
  const cartIds = useSelector((state) => state.order.cart_ids);
  const navigate = useNavigate();
  const dispatch = useDispatch();

  useEffect(() => {
    if (cartIds.length === 0) {
      navigate(Path.userCart());
    }
  }, [cartIds, navigate]);

  const [address, setAddress] = useState(null);
  const [subTotal, setSubTotal] = useState(0);
  const [coupon, setCoupon] = useState(null);
  const [shipping, setShipping] = useState({});

  const handleCheckout = async () => {
    dispatch(startLoading());
    try {
      const response = await axiosWithAuth.post(
        Api.orders(),
        {
          cart_ids: cartIds,
          address_id: address.address_id,
          coupon_id: coupon ? coupon.coupon_id : null,
        },
        {
          navigate,
        }
      );

      window.location.replace(response.data.url);
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      dispatch(stopLoading());
    }
  };

  return (
    <>
      <Container maxWidth="lg">
        <Grid2 container spacing={3} columns={3}>
          <Grid2 size={2}>
            <Address setAddress={setAddress} address={address} />
          </Grid2>

          <Grid2 size={1}>
            <Price
              subTotal={subTotal}
              coupon={coupon}
              handleCheckout={handleCheckout}
              shipping={shipping}
            />
          </Grid2>

          <Grid2 size={3}>
            <ShippingFee
              addressId={address?.address_id}
              shipping={shipping}
              setShipping={setShipping}
            />
          </Grid2>

          <Grid2 size={3}>
            <Coupons
              subTotal={subTotal}
              setCoupon={setCoupon}
              coupon={coupon}
            />
          </Grid2>

          <Grid2 size={3}>
            <Products setSubTotal={setSubTotal} />
          </Grid2>
        </Grid2>
      </Container>
    </>
  );
};

export default Checkout;
