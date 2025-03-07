import { useEffect, useState, useCallback } from "react";
import { Box, Container } from "@mui/material";
import axiosWithAuth from "~/utils/axiosWithAuth";
import Api from "~/helpers/Api";
import CartBox from "./CartBox";

const Cart = () => {
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
            <CartBox cart={cart} />
          </Box>
        ))}
      </Box>
    </Container>
  );
};

export default Cart;
