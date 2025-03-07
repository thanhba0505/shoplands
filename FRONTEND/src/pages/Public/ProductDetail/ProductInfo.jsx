import { useState } from "react";
import {
  Box,
  Typography,
  Button,
  Rating,
  TableContainer,
  Table,
  TableBody,
  TableRow,
  TableCell,
} from "@mui/material";
import PaperCustom from "~/components/PaperCustom";
import Path from "~/helpers/Path";
import ButtonLoading from "~/components/ButtonLoading";
import Format from "~/helpers/Format";
import QuantityInput from "~/components/QuantityInput";
import axiosWithAuth from "~/utils/axiosWithAuth";
import Api from "~/helpers/Api";
import { useNavigate } from "react-router-dom";
import { useSnackbar } from "notistack";
import Auth from "~/helpers/Auth";

// Hình ảnh
const ImageProduct = ({ images }) => {
  const defaultImage = images && images.find((image) => image.default === 1);

  return (
    <>
      {images && (
        <Box
          sx={{
            width: "40%",
            display: "flex",
            flexDirection: "column",
            justifyContent: "start",
            alignItems: "center",
          }}
        >
          <Box sx={{ padding: 2 }}>
            <img
              src={Path.publicProduct(defaultImage?.image_path)}
              alt="Product Image"
              style={{
                width: "100%",
                maxWidth: "400px",
                objectFit: "contain",
                margin: "auto",
              }}
            />
          </Box>
          <Box sx={{ padding: 2, display: "flex", gap: 2 }}>
            {images &&
              images.map((image, key) => (
                <img
                  key={key}
                  src={Path.publicProduct(image.image_path)}
                  alt="Product Image"
                  style={{
                    width: "100px",
                    maxWidth: "400px",
                    objectFit: "contain",
                    margin: "auto",
                  }}
                />
              ))}
          </Box>
        </Box>
      )}
    </>
  );
};

// Thống tin sản phẩm
const InfoProduct = ({ product }) => {
  const [selectedValues, setSelectedValues] = useState({});
  const [quantity, setQuantity] = useState(1);
  const variants = product?.variants;

  const navigate = useNavigate();

  const handleShowPrice = (key, value) => {
    setSelectedValues((prev) => {
      const newSelectedValues = { ...prev }; // Sao chép đối tượng cũ

      if (newSelectedValues[key] === value) {
        // Nếu giá trị hiện tại giống giá trị đã chọn, xóa thuộc tính đó
        delete newSelectedValues[key];
      } else {
        // Nếu không, thêm hoặc cập nhật giá trị mới cho key
        newSelectedValues[key] = value;
      }

      return newSelectedValues;
    });
  };

  const getSelectedVariant = () => {
    if (
      variants &&
      Object.keys(selectedValues).length ===
        Object.keys(product.attributes).length
    ) {
      return variants.find((variant) => {
        return Object.keys(selectedValues).every((key) => {
          const selectedValue = selectedValues[key];
          return variant.values.some(
            (v) => v.name === key && v.value === selectedValue
          );
        });
      });
    }
    return null;
  };

  const selectedVariant = getSelectedVariant();

  const priceToShow = selectedVariant
    ? selectedVariant.promotion_price || selectedVariant.price
    : null;

  const priceFrom = selectedVariant ? selectedVariant.price : product.min_price;
  const priceTo = selectedVariant
    ? selectedVariant.promotion_price || selectedVariant.price
    : product.max_price;

  const productQuantity = selectedVariant
    ? selectedVariant.quantity
    : product.quantity;

  const soldQuantity = selectedVariant
    ? selectedVariant.sold_quantity
    : product.sold_quantity;

  // Xử lý nhập số lượng
  const handleQuantityChange = (newQuantity) => {
    setQuantity(newQuantity);
  };

  return (
    <>
      {product && (
        <Box sx={{ width: "60%", padding: 2 }}>
          <Typography className="line-clamp-3" variant="h5">
            {product.name}
          </Typography>
          <Box sx={{ display: "flex", alignItems: "center" }}>
            <Typography variant="body2" color="textSecondary">
              {product.average_rating}
            </Typography>

            <Rating
              size="small"
              name="read-only"
              readOnly
              value={
                product.average_rating ? parseFloat(product.average_rating) : 0
              }
              precision={0.1}
            />
            <Typography
              variant="body2"
              color="textSecondary"
              sx={{ marginLeft: 1 }}
            >
              ({product.count_reviews} đánh giá)
            </Typography>
          </Box>
          <Typography
            variant="h5"
            fontWeight={"bold"}
            color="#fff"
            sx={{ padding: 2, bgcolor: "primary.light" }}
          >
            {priceToShow
              ? `${Format.formatCurrency(priceToShow)}`
              : `${Format.formatCurrency(priceFrom)} - ${Format.formatCurrency(
                  priceTo
                )}`}
            {priceToShow &&
              selectedVariant &&
              selectedVariant.promotion_price && (
                <Typography
                  variant="body2"
                  color="error"
                  sx={{ display: "inline", marginLeft: 1 }}
                >
                  {Format.formatCurrency(selectedVariant.promotion_price)}
                </Typography>
              )}
            {priceToShow &&
              selectedVariant &&
              selectedVariant.promotion_price && (
                <Typography
                  variant="body2"
                  color="error"
                  sx={{ display: "inline", marginLeft: 1 }}
                >
                  {Format.formatPercentage(
                    (selectedVariant.price - selectedVariant.promotion_price) /
                      selectedVariant.price
                  )}
                </Typography>
              )}
          </Typography>
          <TableContainer>
            <Table sx={{ borderCollapse: "collapse", border: "none" }}>
              <TableBody>
                <TableRow>
                  <TableCell
                    sx={{
                      width: "20%",
                      px: 0,
                      py: 1,
                      border: "none",
                    }}
                  >
                    Tồn kho
                  </TableCell>
                  <TableCell
                    sx={{
                      px: 0,
                      py: 1,
                      border: "none",
                    }}
                  >
                    {productQuantity}
                  </TableCell>
                </TableRow>
                <TableRow>
                  <TableCell
                    sx={{
                      width: "20%",
                      px: 0,
                      py: 1,
                      border: "none",
                    }}
                  >
                    Đã bán
                  </TableCell>
                  <TableCell
                    sx={{
                      px: 0,
                      py: 1,
                      border: "none",
                    }}
                  >
                    {soldQuantity}
                  </TableCell>
                </TableRow>
                {product.attributes &&
                  Object.keys(product.attributes).map((key, index) => (
                    <TableRow key={index}>
                      <TableCell
                        sx={{
                          width: "20%",
                          px: 0,
                          py: 1,
                          border: "none",
                        }}
                      >
                        {key}
                      </TableCell>
                      <TableCell
                        sx={{
                          px: 0,
                          py: 1,
                          border: "none",
                        }}
                      >
                        <Box
                          sx={{
                            display: "flex",
                            gap: 1,
                            flexWrap: "wrap",
                          }}
                        >
                          {" "}
                          {product.attributes[key].map((value, subIndex) => (
                            <Button
                              variant="outlined"
                              key={subIndex}
                              onClick={() => handleShowPrice(key, value)}
                              sx={{
                                backgroundColor:
                                  selectedValues[key] === value
                                    ? "primary.light"
                                    : "#fff",
                                color:
                                  selectedValues[key] === value
                                    ? "#fff"
                                    : "primary.light",
                              }}
                            >
                              {value}
                            </Button>
                          ))}
                        </Box>
                      </TableCell>
                    </TableRow>
                  ))}
                {/* Số lượng */}
                <TableRow>
                  <TableCell
                    sx={{
                      width: "20%",
                      px: 0,
                      py: 1,
                      border: "none",
                    }}
                  >
                    Số lượng
                  </TableCell>
                  <TableCell
                    sx={{
                      px: 0,
                      py: 1,
                      border: "none",
                    }}
                  >
                    <Box sx={{ display: "flex", alignItems: "center" }}>
                      <QuantityInput
                        min={1}
                        max={productQuantity}
                        value={quantity}
                        onChange={handleQuantityChange}
                      />
                    </Box>
                  </TableCell>
                </TableRow>
              </TableBody>
            </Table>
          </TableContainer>

          {/* Nút xử lý */}
          {Auth.checkUser() ? (
            <BtnHandle selectedVariant={selectedVariant} quantity={quantity} />
          ) : (
            <ButtonLoading
              variant="contained"
              sx={{ width: "100%" }}
              onClick={() => navigate(Path.login())}
            >
              Đăng nhập để mua sản phẩm
            </ButtonLoading>
          )}
        </Box>
      )}
    </>
  );
};

// Xử lý thêm vào giỏ hàng
const BtnHandle = ({ selectedVariant, quantity }) => {
  const navigate = useNavigate();
  const { enqueueSnackbar } = useSnackbar();

  const handleAddToCart = async () => {
    if (!selectedVariant) {
      enqueueSnackbar("Hãy chọn thuộc tính sản phẩm", { variant: "warning" });
      return;
    }
    try {
      const response = await axiosWithAuth.post(
        Api.cart(),
        {
          product_variant_id: selectedVariant.product_variant_id,
          quantity,
        },
        { navigate }
      );
      if (response.status === 200 || response.status === 201) {
        enqueueSnackbar(response.data.message, { variant: "success" });
      }
    } catch (error) {
      console.log(error.response?.data?.message);
      if (error.response?.data?.quantity !== selectedVariant.quantity) {
        window.location.reload();
      }
    }
  };

  return (
    <Box sx={{ display: "flex", gap: 2 }}>
      <ButtonLoading
        sx={{ width: "50%" }}
        variant="outlined"
        onClick={handleAddToCart}
      >
        Thêm vào giỏ hàng
      </ButtonLoading>
      <ButtonLoading sx={{ width: "50%" }} variant="contained">
        Mua ngay
      </ButtonLoading>
    </Box>
  );
};

const ProductInfo = ({ product }) => {
  return (
    <PaperCustom sx={{ display: "flex" }}>
      <ImageProduct images={product?.images} />
      <InfoProduct product={product} />
    </PaperCustom>
  );
};

export default ProductInfo;
