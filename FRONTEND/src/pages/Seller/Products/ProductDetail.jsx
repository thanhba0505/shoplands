import {
  Box,
  Divider,
  Grid2,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableRow,
  Typography,
} from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import axiosDefault from "~/utils/axiosDefault";

const ProductDetail = () => {
  const params = useParams();
  const [loading, setLoading] = useState(false);
  const [product, setProduct] = useState(null);
  const [seemore, setSeeMore] = useState(false);

  const [defaultImage, setDefaultImage] = useState(null);

  const fetchApi = useCallback(async () => {
    setLoading(true);
    try {
      if (params.productId) {
        const response = await axiosDefault.get(Api.products(params.productId));
        setProduct(response.data);
        setDefaultImage(
          response.data.images.find((image) => image.default === 1)
        );
      }
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  }, [params.productId]);

  useEffect(() => {
    fetchApi();
  }, [fetchApi]);

  const formatAttributes = (attributes) => {
    return Object.entries(attributes).map(([key, value], index) => (
      <span key={index}>
        {key}: {value.join(", ")}
        <br />
      </span>
    ));
  };

  return (
    <PaperCustom>
      {loading ? (
        <Typography>Loading...</Typography>
      ) : (
        <>
          <Box sx={{ width: "100%", mb: 2 }}>
            <Typography
              variant="h6"
              fontWeight={"bold"}
              sx={{ borderBottom: 1, pb: 2 }}
              textAlign={"center"}
            >
              {product?.name}
            </Typography>

            <TableContainer>
              <Table>
                <TableBody>
                  <TableRow>
                    <TableCell width={"120px"}>Giá</TableCell>
                    <TableCell>
                      {product?.min_price === product?.max_price
                        ? Format.formatCurrency(product?.min_price)
                        : `${Format.formatCurrency(
                            product?.min_price
                          )} - ${Format.formatCurrency(product?.max_price)}`}
                    </TableCell>
                    <TableCell
                      rowSpan={4}
                      width={"30%"}
                      sx={{ verticalAlign: "top" }}
                    >
                      <Box
                        sx={{
                          width: "100%",
                          display: "flex",
                          py: 1,
                          flexDirection: "column",
                          justifyContent: "start",
                          alignItems: "center",
                        }}
                      >
                        {product && product.images && defaultImage && (
                          <>
                            <Box>
                              <img
                                src={Path.publicProduct(
                                  defaultImage?.image_path
                                )}
                                alt="Product Image"
                                style={{
                                  width: "100%",
                                  maxWidth: "200px",
                                  objectFit: "contain",
                                  margin: "auto",
                                }}
                              />
                            </Box>
                            <Box
                              sx={{
                                padding: 2,
                                display: "flex",
                                gap: 2,
                                flexWrap: "wrap",
                                justifyContent: "center",
                              }}
                            >
                              {product &&
                                product.images &&
                                product.images.map((image, key) => (
                                  <img
                                    onClick={() => setDefaultImage(image)}
                                    key={key}
                                    src={Path.publicProduct(image.image_path)}
                                    alt="Product Image"
                                    style={{
                                      border: "1px solid #ccc",
                                      borderRadius: "4px",
                                      cursor: "pointer",
                                      width: "50px",
                                      maxWidth: "400px",
                                      objectFit: "contain",
                                    }}
                                  />
                                ))}
                            </Box>
                          </>
                        )}
                      </Box>
                    </TableCell>
                  </TableRow>

                  <TableRow>
                    <TableCell>Danh mục</TableCell>
                    <TableCell>{product?.category?.name}</TableCell>
                  </TableRow>

                  <TableRow>
                    <TableCell>Thuộc tính</TableCell>
                    <TableCell>
                      {product?.attributes &&
                        formatAttributes(product.attributes)}
                    </TableCell>
                  </TableRow>

                  <TableRow>
                    <TableCell>Chi tiết thuộc tính</TableCell>
                    <TableCell sx={{ pr: 0}}>
                      <Grid2
                        container
                        spacing={1}
                        columns={5}
                        textAlign={"center"}
                      >
                        <Grid2 size={1}></Grid2>
                        <Grid2 size={1}>Giá</Grid2>
                        <Grid2 size={1}>Giảm giá</Grid2>
                        <Grid2 size={1}>Tồn kho</Grid2>
                        <Grid2 size={1}>Đã bán</Grid2>

                        <Grid2 size={5}>
                          <Divider />
                        </Grid2>

                        {product?.variants &&
                          product.variants.map((variant) => {
                            return (
                              <>
                                <Grid2
                                  key={variant.product_variant_id}
                                  size={1}
                                >
                                  {variant.values
                                    .map((value) => value.value)
                                    .join(", ")}
                                </Grid2>
                                <Grid2 size={1}>
                                  {Format.formatCurrency(variant.price)}
                                </Grid2>
                                <Grid2 size={1}>
                                  {variant.promotion_price}
                                </Grid2>
                                <Grid2 size={1}>{variant.quantity}</Grid2>
                                <Grid2 size={1}>{variant.sold_quantity}</Grid2>
                              </>
                            );
                          })}
                      </Grid2>
                    </TableCell>
                  </TableRow>

                  <TableRow>
                    <TableCell>Mô tả</TableCell>
                    <TableCell sx={{ whiteSpace: "pre-line" }}>
                      <Typography
                        variant="body2"
                        className={seemore ? "" : "line-clamp-12"}
                      >
                        {product?.description}
                      </Typography>
                      <Typography
                        variant="body2"
                        onClick={() => setSeeMore(!seemore)}
                        color="primary"
                        sx={{
                          cursor: "pointer",
                          mt: 1,
                        }}
                      >
                        {seemore ? "Ẩn" : "Xem thêm"}
                      </Typography>
                    </TableCell>
                  </TableRow>
                </TableBody>
              </Table>
            </TableContainer>
          </Box>
        </>
      )}
    </PaperCustom>
  );
};

export default ProductDetail;
