import { useEffect, useState } from "react";
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
  Skeleton,
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
const ImageProduct = ({ images, loading }) => {
  const [defaultImage, setDefaultImage] = useState(null);

  useEffect(() => {
    const defaultImage = images && images.find((image) => image.default === 1);
    setDefaultImage(defaultImage);
  }, [images]);

  return (
    <>
      <Box
        sx={{
          width: "40%",
          display: "flex",
          flexDirection: "column",
          justifyContent: "start",
          alignItems: "center",
        }}
      >
        <Box sx={{ padding: 2, pt: 0 }}>
          {loading ? (
            <Skeleton
              animation="pulse"
              variant="rectangular"
              height={400}
              width={400}
            />
          ) : (
            <img
              src={Path.publicProduct(defaultImage?.image_path)}
              alt="Product Image"
              style={{
                width: "100%",
                maxWidth: "400px",
                objectFit: "contain",
                margin: "auto",
                userSelect: "none",
                display: "block",
              }}
            />
          )}
        </Box>
        <Box
          sx={{
            width: "100%",
            overflowX: "auto",
            "::-webkit-scrollbar": { height: 8 },
          }}
        >
          <Box
            sx={{
              paddingBottom: 2,
              display: "flex",
              gap: 1,
              flexWrap: "nowrap",
              justifyContent: images && images.length > 4 ? "start" : "center",
            }}
          >
            {loading ? (
              <>
                <Skeleton
                  animation="pulse"
                  variant="rectangular"
                  height={100}
                  width={100}
                />
                <Skeleton
                  animation="pulse"
                  variant="rectangular"
                  height={100}
                  width={100}
                />
                <Skeleton
                  animation="pulse"
                  variant="rectangular"
                  height={100}
                  width={100}
                />
                <Skeleton
                  animation="pulse"
                  variant="rectangular"
                  height={100}
                  width={100}
                />
              </>
            ) : (
              <>
                {images.map((image, key) => (
                  <img
                    key={key}
                    src={Path.publicProduct(image.image_path)}
                    alt="Product Image"
                    style={{
                      width: "100px",
                      maxWidth: "400px",
                      objectFit: "contain",
                      cursor: "pointer",
                      userSelect: "none",
                    }}
                    onClick={() => {
                      setDefaultImage(image);
                    }}
                  />
                ))}
              </>
            )}
          </Box>
        </Box>
      </Box>
    </>
  );
};

// Thống tin sản phẩm
const InfoProduct = ({ product, loading }) => {
  const [selectedValues, setSelectedValues] = useState({});
  const [quantity, setQuantity] = useState(1);
  const variants = product?.variants;

  const navigate = useNavigate();

  useEffect(() => {
    setSelectedValues({});
    setQuantity(1);
  }, [product]);

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
      product.attributes &&
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
      {loading ? (
        <>
          <Box
            sx={{
              width: "60%",
              display: "flex",
              flexDirection: "column",
              gap: 2,
              justifyContent: "space-between",
              pb: 2,
            }}
          >
            <Box
              sx={{
                display: "flex",
                alignItems: "center",
                gap: 1,
                flexWrap: "wrap",
              }}
            >
              <Skeleton
                animation="pulse"
                variant="rounded"
                height={30}
                width={"100%"}
              />
              <Skeleton
                animation="pulse"
                variant="rounded"
                height={30}
                width={"80%"}
              />
              <Skeleton animation="pulse" variant="text" width={"50%"} />
              <Skeleton
                animation="pulse"
                variant="text"
                height={60}
                width={"100%"}
              />
              <Box display={"flex"} gap={2} width={"100%"} mt={1}>
                <Skeleton animation="pulse" variant="text" width={"30%"} />
                <Skeleton animation="pulse" variant="text" width={"60%"} />
              </Box>
              <Box display={"flex"} gap={2} width={"100%"} mt={1}>
                <Skeleton animation="pulse" variant="text" width={"30%"} />
                <Skeleton animation="pulse" variant="text" width={"50%"} />
              </Box>
              <Box display={"flex"} gap={2} width={"100%"} mt={1}>
                <Skeleton animation="pulse" variant="text" width={"30%"} />
                <Skeleton animation="pulse" variant="text" width={"70%"} />
              </Box>
              <Box display={"flex"} gap={2} width={"100%"} mt={1}>
                <Skeleton animation="pulse" variant="text" width={"30%"} />
                <Skeleton animation="pulse" variant="text" width={"40%"} />
              </Box>
              <Box display={"flex"} gap={2} width={"100%"} mt={1}>
                <Skeleton animation="pulse" variant="text" width={"30%"} />
                <Skeleton animation="pulse" variant="text" width={"50%"} />
              </Box>
            </Box>
            <Box sx={{ display: "flex", alignItems: "center", gap: 1 }}>
              <Skeleton
                animation="pulse"
                variant="rounded"
                height={45}
                width={"100%"}
              />
            </Box>
          </Box>
        </>
      ) : (
        <Box
          sx={{
            width: "60%",
            display: "flex",
            flexDirection: "column",
            gap: 2,
            justifyContent: "space-between",
            pb: 2,
          }}
        >
          <Box
            sx={{
              display: "flex",
              alignItems: "center",
              gap: 1,
              flexWrap: "wrap",
            }}
          >
            <Typography
              sx={{ width: "100%" }}
              className="line-clamp-3"
              variant="h5"
            >
              {product.name}
            </Typography>

            <Typography
              variant="body2"
              color="textSecondary"
              lineHeight={1}
              sx={{ mt: 0.5 }}
            >
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
              lineHeight={1}
              color="textSecondary"
              sx={{ marginLeft: 1, mt: 0.5 }}
            >
              ({product.count_reviews} đánh giá)
            </Typography>

            <Box
              sx={{
                width: "100%",
                padding: 2,
                backgroundColor: "primary.light",
                display: "flex",
                alignItems: "end",
                gap: 1,
                mt: 0.5,
              }}
            >
              <Typography
                variant="h5"
                sx={{ color: "white", fontWeight: "bold", lineHeight: 1 }}
              >
                {priceToShow
                  ? `${Format.formatCurrency(priceToShow)}`
                  : `${Format.formatCurrency(
                      priceFrom
                    )} - ${Format.formatCurrency(priceTo)}`}
              </Typography>

              {priceToShow &&
                selectedVariant &&
                selectedVariant.promotion_price && (
                  <Typography
                    variant="body2"
                    sx={{
                      display: "inline",
                      marginLeft: 1,
                      textDecoration: "line-through",
                      lineHeight: 1,
                      color: "#fff",
                    }}
                  >
                    {Format.formatCurrency(selectedVariant.price)}
                  </Typography>
                )}
              {priceToShow &&
                selectedVariant &&
                selectedVariant.promotion_price && (
                  <Typography
                    variant="body2"
                    color="textPrimary"
                    sx={{
                      display: "inline",
                      marginLeft: 1,
                      backgroundColor: "#fff",
                      px: 1,
                      py: 0.5,
                      borderRadius: 1,
                      lineHeight: 1,
                    }}
                  >
                    {Format.formatPercentage(
                      (selectedVariant.price -
                        selectedVariant.promotion_price) /
                        selectedVariant.price
                    )}
                  </Typography>
                )}
            </Box>

            <TableContainer sx={{ width: "100%", mt: 2 }}>
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
                      Trạng thái
                    </TableCell>
                    <TableCell
                      sx={{
                        px: 0,
                        py: 1,
                        border: "none",
                      }}
                    >
                      {Format.formatStatus(product.status)}
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
                  {product.status === "active" && (
                    <>
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
                    </>
                  )}
                </TableBody>
              </Table>
            </TableContainer>
          </Box>

          {/* Nút xử lý */}
          {product.status === "active" ? (
            <>
              {Auth.checkUser() ? (
                <BtnHandle
                  selectedVariant={selectedVariant}
                  quantity={quantity}
                  attributes={product?.attributes}
                  product={product}
                />
              ) : (
                <ButtonLoading
                  size="large"
                  variant="contained"
                  sx={{ width: "100%" }}
                  onClick={() => navigate(Path.login())}
                >
                  Đăng nhập để mua sản phẩm
                </ButtonLoading>
              )}
            </>
          ) : (
            <>
              {product.status === "locked" && (
                <Button fullWidth size="large" variant="contained" disabled>
                  Sản phẩm đã bị khóa
                </Button>
              )}
              {product.status === "deleted" && (
                <Button fullWidth size="large" variant="contained" disabled>
                  Sản phẩm đã bị xóa
                </Button>
              )}
            </>
          )}
        </Box>
      )}
    </>
  );
};

// Xử lý thêm vào giỏ hàng
const BtnHandle = ({ selectedVariant, quantity, attributes, product }) => {
  const navigate = useNavigate();
  const { enqueueSnackbar } = useSnackbar();

  const handleAddToCart = async () => {
    let variantToAdd = selectedVariant;

    // If no attributes to select OR no variant selected but product has variants
    if (!variantToAdd) {
      if (attributes && Object.keys(attributes).length > 0) {
        // Product has attributes but none selected
        enqueueSnackbar("Hãy chọn thuộc tính sản phẩm", { variant: "warning" });
        return;
      } else if (product?.variants && product.variants.length > 0) {
        // Product has no attributes, use the first variant
        variantToAdd = product.variants[0];
      } else {
        enqueueSnackbar("Không thể thêm sản phẩm vào giỏ hàng", {
          variant: "error",
        });
        return;
      }
    }

    try {
      const response = await axiosWithAuth.post(
        Api.cart(),
        {
          product_variant_id: variantToAdd.product_variant_id,
          quantity,
        },
        { navigate }
      );
      if (response.status === 200 || response.status === 201) {
        enqueueSnackbar(response.data.message, { variant: "success" });
      }
    } catch (error) {
      console.log(error.response?.data?.message);
      if (error.response?.data?.quantity !== variantToAdd.quantity) {
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
        size="large"
      >
        Thêm vào giỏ hàng
      </ButtonLoading>
      <ButtonLoading
        size="large"
        sx={{ width: "50%" }}
        variant="contained"
        onClick={() => navigate(Path.userCart())}
      >
        Xem giỏ hàng
      </ButtonLoading>
    </Box>
  );
};

const ProductInfo = ({ product, loading }) => {
  return (
    <PaperCustom sx={{ display: "flex", gap: 3, px: 3, pt: 4 }}>
      <ImageProduct images={product?.images} loading={loading} />
      <InfoProduct product={product} loading={loading} />
    </PaperCustom>
  );
};

export default ProductInfo;
