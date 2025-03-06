import { useEffect, useState } from "react";
import { Box, IconButton, TextField } from "@mui/material";
import { Add, Remove } from "@mui/icons-material";

const QuantityInput = ({ min = 1, max = 100, value = 1, onChange }) => {
  const [quantity, setQuantity] = useState(Number(value));

  const handleIncrease = () => {
    if (quantity < max) {
      setQuantity((prev) => prev + 1);
      onChange(quantity + 1);
    }
  };

  const handleDecrease = () => {
    if (quantity > min) {
      setQuantity((prev) => prev - 1);
      onChange(quantity - 1);
    }
  };

  const handleInputChange = (event) => {
    const value = Number(event.target.value);
    if (value >= min && value <= max) {
      setQuantity(value);
      onChange(value);
    } else if (value < min) {
      setQuantity(min);
      onChange(min);
    } else if (value > max) {
      setQuantity(max);
      onChange(max);
    }
  };

  useEffect(() => {
    setQuantity(1);
  }, [max]);

  return (
    <Box sx={{ display: "flex", alignItems: "center", gap: 2 }}>
      <IconButton onClick={handleDecrease} disabled={quantity <= min}>
        <Remove />
      </IconButton>
      <TextField
        value={quantity}
        onChange={handleInputChange}
        variant="outlined"
        size="small"
        sx={{ width: "60px", textAlign: "center" }}
      />
      <IconButton onClick={handleIncrease} disabled={quantity >= max}>
        <Add />
      </IconButton>
    </Box>
  );
};

export default QuantityInput;
