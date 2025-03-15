import {
  Box,
  Container,
  FormControl,
  FormControlLabel,
  Radio,
  RadioGroup,
  Typography,
} from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import { useNavigate } from "react-router-dom";
import Api from "~/helpers/Api";
import Path from "~/helpers/Path";
import { setAddresses } from "~/redux/authSlice";
import axiosWithAuth from "~/utils/axiosWithAuth";

const Address = () => {
  const navigate = useNavigate();
  const dispatch = useDispatch();
  const addresses = useSelector((state) => state.auth.addresses);

  const [address, setAddress] = useState(null);

  const fetchProducts = useCallback(async () => {
    try {
      const response = await axiosWithAuth.get(Api.address());
      dispatch(setAddresses(response.data));
    } catch (error) {
      if (error.response?.status === 401) {
        navigate(Path.login());
      }
    }
  }, [navigate, dispatch]);

  useEffect(() => {
    fetchProducts();
  }, [fetchProducts]);

  return (
    <Container>
      <Box>
        <Typography variant="h5">Địa chỉ</Typography>

        <FormControl>
          <RadioGroup
            aria-labelledby="demo-controlled-radio-buttons-group"
            name="controlled-radio-buttons-group"
            value={address}
            onChange={(e) => setAddress(e.target.value)}
          >
            {(addresses &&
              addresses.length > 0 &&
              addresses.map((item, index) => (
                <FormControlLabel
                  key={index}
                  value={item.address_id}
                  control={<Radio />}
                  label={item.province_name + " - " + item.address_line}
                />
              ))) || <div>Khong co dia chi</div>}
          </RadioGroup>
        </FormControl>
      </Box>
    </Container>
  );
};

const Products = () => {
  return <div>Products</div>;
};

const Coupons = () => {
  return <div>Coupons</div>;
};

const Checkout = () => {
  return (
    <>
      <Address />
      <Products />
      <Coupons />
    </>
  );
};

export default Checkout;
