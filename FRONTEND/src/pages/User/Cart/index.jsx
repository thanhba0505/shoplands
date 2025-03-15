import { useEffect, useState, useCallback } from "react";
import { Box, Container } from "@mui/material";
import axiosWithAuth from "~/utils/axiosWithAuth";
import Api from "~/helpers/Api";
import CartBox from "./CartBox";
import { useNavigate } from "react-router-dom";
import Log from "~/helpers/Log";

const Cart = () => {
  const [carts, setCarts] = useState([]);
  const navigate = useNavigate();

  const fetchCarts = useCallback(async () => {
    try {
      const response = await axiosWithAuth.get(Api.cart(), { navigate });
      setCarts(response.data);
    } catch (error) {
      Log.error(error.response?.data?.message);
    }
  }, [navigate]);

  useEffect(() => {
    fetchCarts();
  }, [fetchCarts]);

  return (
    <Container>
      <Box sx={{ width: "100%", padding: 2 }}>
        {carts?.groups?.map((cart, index) => (
          <Box key={index} sx={{ marginBottom: 4 }}>
            <CartBox cart={cart} />
          </Box>
        ))}
      </Box>
    </Container>
  );
};

export default Cart;
