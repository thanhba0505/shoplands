import { Box, Button } from "@mui/material";
import { useState, useEffect, useCallback } from "react";
import { useNavigate } from "react-router-dom";
import Api from "~/helpers/Api";
import axiosWithAuth from "~/utils/axiosWithAuth";

const Cart = () => {
  const navigate = useNavigate();
  const [carts, setCarts] = useState([]);

  // 🔹 Dùng useCallback để tránh re-create hàm
  const fetchCarts = useCallback(async () => {
    try {
      const response = await axiosWithAuth.get(Api.cart(), {
        navigate: navigate,
      });
      setCarts(response.data);
    } catch (error) {
        console.log(error.response?.data?.message);
    }
  }, [navigate]);

  // 🔥 Gọi API khi component mount
  useEffect(() => {
    fetchCarts();
  }, [fetchCarts]);

  return (
    <Box>
      <Button variant="outlined" onClick={fetchCarts}>
        Refresh Carts
      </Button>
      <Box padding={3}>
        {carts.length > 0 ? (
          carts.map((cart, index) => (
            <Box key={index}>
              {cart.name} - {cart.quantity}
            </Box>
          ))
        ) : (
          <Box>Giỏ hàng trống</Box>
        )}
      </Box>
    </Box>
  );
};

export default Cart;
