import { useState } from "react";
import axiosWithAuth from "~/utils/axiosWithAuth";
import Api from "~/helpers/Api";
import Log from "~/helpers/Log";
import { Button, TextField, Box, Typography } from "@mui/material";

const NewProducts = () => {
  const [name, setName] = useState("");
  const [images, setImages] = useState([]);

  const handleNameChange = (event) => {
    setName(event.target.value);
  };

  const handleImageChange = (event) => {
    const files = Array.from(event.target.files); // Chọn nhiều tệp
    if (files) {
      setImages(files); // Lưu các tệp ảnh vào state
    }
  };

  const handleSubmit = async () => {
    console.log("Product Name:", name);
    console.log("Product Images:", images);

    try {
      const formData = new FormData();
      formData.append("name", name);
      images.forEach((image) => {
        formData.append("images[]", image); // Đảm bảo tên trường "images[]" là mảng nếu backend yêu cầu
      });

      // Dữ liệu JSON cần gửi (ví dụ status, description, v.v.)
      const jsonData = {
        status: "active", // Một ví dụ dữ liệu JSON bạn cần gửi
        description: "Mô tả sản phẩm",
      };

      // Append dữ liệu JSON vào FormData dưới dạng stringified JSON
      formData.append("json_data", JSON.stringify(jsonData));

      const response = await axiosWithAuth.post(
        Api.sellerProducts(),
        formData,
        {
          headers: {
            "Content-Type": "multipart/form-data", // Đảm bảo header đúng cho việc gửi tệp
          },
        }
      );

      console.log("Response:", response);
      // Xử lý thành công nếu cần
    } catch (error) {
      Log.error(error.response?.data?.message);
    }
  };

  return (
    <Box sx={{ maxWidth: 400, margin: "0 auto", padding: 2 }}>
      <Typography variant="h6" gutterBottom>
        Thêm sản phẩm mới
      </Typography>

      {/* Trường nhập tên sản phẩm */}
      <Box sx={{ marginBottom: 2 }}>
        <Typography variant="body2">Tên sản phẩm</Typography>
        <TextField
          fullWidth
          variant="outlined"
          value={name}
          onChange={handleNameChange}
          sx={{ marginTop: "8px" }}
        />
      </Box>

      {/* Button để chọn ảnh */}
      <Box sx={{ marginBottom: 2 }}>
        <input
          accept="image/*"
          id="product-image"
          type="file"
          multiple
          style={{ display: "none" }}
          onChange={handleImageChange}
        />
        <label htmlFor="product-image">
          <Button variant="contained" component="span">
            Chọn ảnh
          </Button>
        </label>
      </Box>

      {/* Hiển thị ảnh đã chọn */}
      {images.length > 0 && (
        <Box sx={{ marginTop: 2 }}>
          <Typography variant="body2">Ảnh đã chọn:</Typography>
          <Box sx={{ display: "flex", gap: 2, flexWrap: "wrap" }}>
            {images.map((image, index) => (
              <img
                key={index}
                src={URL.createObjectURL(image)} // Hiển thị ảnh tạm thời
                alt={`Product image ${index + 1}`}
                style={{
                  maxWidth: "100px",
                  height: "auto",
                  marginBottom: "10px",
                }}
              />
            ))}
          </Box>
        </Box>
      )}

      {/* Nút submit */}
      <Box sx={{ marginTop: 2 }}>
        <Button variant="contained" color="primary" onClick={handleSubmit}>
          Thêm sản phẩm
        </Button>
      </Box>
    </Box>
  );
};

export default NewProducts;
