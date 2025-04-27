import { useEffect, useState } from "react";
import { Box, IconButton, InputBase } from "@mui/material";
import { Add, Remove } from "@mui/icons-material";

const QuantityInput = ({ min = 1, max = 100, value = 1, onChange, sx }) => {
  const [quantity, setQuantity] = useState(Number(value));

  // Cập nhật lại quantity nếu min/max thay đổi
  useEffect(() => {
    // Nếu quantity nhỏ hơn min, đặt lại thành min
    if (quantity < min) {
      setQuantity(min);
      onChange(min);
    } else if (quantity > max) {
      setQuantity(max);
      onChange(max);
    }
  }, [min, max, quantity, onChange]); // Đảm bảo nó chạy khi min/max thay đổi

  const handleIncrease = () => {
    if (quantity < max) {
      setQuantity((prev) => {
        const newQuantity = prev + 1;
        onChange(newQuantity); // Gọi callback khi thay đổi số lượng
        return newQuantity;
      });
    }
  };

  const handleDecrease = () => {
    if (quantity > min) {
      setQuantity((prev) => {
        const newQuantity = prev - 1;
        onChange(newQuantity); // Gọi callback khi thay đổi số lượng
        return newQuantity;
      });
    }
  };

  const handleInputChange = (event) => {
    const value = Number(event.target.value);
    if (value >= min && value <= max) {
      setQuantity(value);
      onChange(value); // Gọi callback khi giá trị thay đổi
    } else if (value < min) {
      setQuantity(min);
      onChange(min); // Gọi callback nếu dưới min
    } else if (value > max) {
      setQuantity(max);
      onChange(max); // Gọi callback nếu trên max
    }
  };

  return (
    <Box
      sx={{
        display: "flex",
        alignItems: "center",
        gap: 0.5,
        border: "1px solid #ccc",
        borderRadius: "4px",
        width: "fit-content",
        px: 1,
        mx: "auto",
        ...sx,
      }}
    >
      <IconButton
        size="small"
        onClick={handleDecrease}
        disabled={quantity <= min}
      >
        <Remove />
      </IconButton>
      <InputBase
        value={quantity}
        onChange={handleInputChange}
        sx={{
          input: { textAlign: "center" },
          width: "50px",
          height: "40px",
          border: "none",
        }}
      />
      <IconButton
        size="small"
        onClick={handleIncrease}
        disabled={quantity >= max}
      >
        <Add />
      </IconButton>
    </Box>
  );
};

export default QuantityInput;
