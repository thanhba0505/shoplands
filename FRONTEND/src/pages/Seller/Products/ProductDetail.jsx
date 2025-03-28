import {
  Box,
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
        <Box display="flex" gap={2} justifyContent={"space-between"}>
          <Box sx={{ width: "100%" }}>
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
                  </TableRow>
                  <TableRow>
                    <TableCell>Danh mục</TableCell>
                    <TableCell>{product?.category?.name}</TableCell>
                  </TableRow>
                  <TableRow>
                    <TableCell>Mô tả</TableCell>
                    <TableCell>{product?.description}</TableCell>
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
                    <TableCell>
                      {product?.variants &&
                        product.variants.map((variant) => {
                          return (
                            <Box
                              key={variant.id}
                              sx={{
                                display: "flex",
                                gap: 2,
                                alignItems: "center",
                              }}
                            >
                              <Box>{variant.quantity}</Box>
                            </Box>
                          );
                        })}
                    </TableCell>
                  </TableRow>
                </TableBody>
              </Table>
            </TableContainer>
          </Box>
          <Box
            sx={{
              width: "40%",
              display: "flex",
              flexDirection: "column",
              justifyContent: "start",
              alignItems: "center",
            }}
          >
            {product && product.images && defaultImage && (
              <>
                <Box>
                  <img
                    src={Path.publicProduct(defaultImage?.image_path)}
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
        </Box>
      )}
    </PaperCustom>
  );
};

export default ProductDetail;
