import { Container } from "@mui/material";
import { useEffect, useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import { useNavigate } from "react-router-dom";
import ButtonLoading from "~/components/ButtonLoading";
import Api from "~/helpers/Api";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import { startLoading, stopLoading } from "~/redux/loadingSlice";
import { setQrAndOrderId } from "~/redux/orderSlice";
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
  const [shippingFee, setShippingFee] = useState(null);

  const [isLoading, setIsLoading] = useState(false);

  const handleCheckout = async () => {
    dispatch(startLoading());
    setIsLoading(true);
    try {
      const response = await axiosWithAuth.post(
        Api.orders(),
        {
          cart_ids: cartIds,
          address_id: address.address_id,
          shipping_fee_id: shippingFee.shipping_fee_id,
          coupon_id: coupon ? coupon.coupon_id : null,
        },
        {
          navigate,
        }
      );

      dispatch(setQrAndOrderId(response.data));
      navigate(Path.userOrders("payment"));
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setIsLoading(false);
      dispatch(stopLoading());
    }
  };

  return (
    <>
      <Container>
        <Address setAddress={setAddress} address={address} />
      </Container>

      <Container>
        <Products setSubTotal={setSubTotal} />
      </Container>

      <Container>
        <Coupons subTotal={subTotal} setCoupon={setCoupon} coupon={coupon} />
      </Container>

      <Container>
        <ShippingFee
          setShippingFee={setShippingFee}
          shippingFee={shippingFee}
        />
      </Container>

      <Price subTotal={subTotal} shippingFee={shippingFee} coupon={coupon} />

      <Container>
        <ButtonLoading
          onClick={handleCheckout}
          variant="contained"
          loading={isLoading}
        >
          Thanh toán
        </ButtonLoading>
      </Container>
    </>
  );
};

export default Checkout;
