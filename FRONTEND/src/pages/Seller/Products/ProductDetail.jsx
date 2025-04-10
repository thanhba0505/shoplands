import {
  Box,
  Button,
  Divider,
  Grid2,
  Skeleton,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableRow,
  TextField,
  Typography,
} from "@mui/material";
import { useSnackbar } from "notistack";
import React, { useCallback, useEffect, useState } from "react";
import { useNavigate, useParams } from "react-router-dom";
import ButtonLoading from "~/components/ButtonLoading";
import ModalCustom from "~/components/ModalCustom";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import axiosDefault from "~/utils/axiosDefault";
import axiosWithAuth from "~/utils/axiosWithAuth";

const ModalUpdateProduct = ({
  open,
  setOpen,
  productId,
  variants,
  setProduct,
}) => {
  const navigate = useNavigate();
  const { enqueueSnackbar } = useSnackbar();

  const [loading, setLoading] = useState(false);
  const [variantsEdit, setVariantsEdit] = useState(
    Array.isArray(variants)
      ? variants.map((variant) => ({
          product_variant_id: variant.product_variant_id,
          price: parseFloat(variant.price),
          promotion_price: !variant.promotion_price
            ? null
            : parseFloat(variant.promotion_price),
          quantity: parseFloat(variant.quantity),
          values: variant.values,
        }))
      : []
  );

  const handleInputChange = (index, field, value) => {
    setVariantsEdit((prevVariants) => {
      const updatedVariants = [...prevVariants];
      updatedVariants[index][field] = parseFloat(value);
      return updatedVariants;
    });
  };

  const handleSave = async () => {
    setLoading(true);
    try {
      const response = await axiosWithAuth.put(
        Api.sellerProducts(productId),
        {
          variants: variantsEdit,
        },
        {
          navigate,
        }
      );

      setProduct(response.data);
      setOpen(false);

      enqueueSnackbar("Cập nhật sản phẩm thành công", {
        variant: "success",
      });
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  };

  return (
    <ModalCustom
      open={open}
      handleClose={() => setOpen(false)}
      title="Cập nhật sản phẩm"
      sx={{ width: 1000 }}
    >
      <Grid2 container spacing={1} columns={4} textAlign={"center"}>
        <Grid2
          size={5}
          container
          columns={4}
          sx={{
            fontWeight: "bold",
            position: "sticky",
            top: 0,
            backgroundColor: "white",
            zIndex: 1,
            pb: 1,
          }}
        >
          <Grid2 sx={{ fontWeight: "bold" }} size={1}>
            Thuộc tính
          </Grid2>
          <Grid2 sx={{ fontWeight: "bold" }} size={1}>
            Tồn kho
          </Grid2>
          <Grid2 sx={{ fontWeight: "bold" }} size={1}>
            Giá
          </Grid2>
          <Grid2 sx={{ fontWeight: "bold" }} size={1}>
            Giảm giá
          </Grid2>

          <Grid2 size={4}>
            <Divider />
          </Grid2>
        </Grid2>

        {variantsEdit &&
          variantsEdit.map((variant, index) => (
            <React.Fragment key={variant.product_variant_id}>
              <Grid2 size={1}>
                {variant.values.map((value) => value.value).join(", ")}
              </Grid2>

              <Grid2 size={1}>
                <TextField
                  size="small"
                  sx={{ "& input": { textAlign: "center" } }}
                  value={variant.quantity}
                  onChange={(e) =>
                    handleInputChange(index, "quantity", e.target.value)
                  }
                />
              </Grid2>

              <Grid2 size={1}>
                <TextField
                  size="small"
                  sx={{ "& input": { textAlign: "center" } }}
                  value={variant.price}
                  onChange={(e) =>
                    handleInputChange(index, "price", e.target.value)
                  }
                />
              </Grid2>

              <Grid2 size={1}>
                <TextField
                  size="small"
                  sx={{ "& input": { textAlign: "center" } }}
                  value={variant.promotion_price}
                  onChange={(e) =>
                    handleInputChange(index, "promotion_price", e.target.value)
                  }
                />
              </Grid2>
            </React.Fragment>
          ))}

        <Grid2
          container
          columns={2}
          spacingX={3}
          spacingY={1}
          pt={1}
          size={5}
          sx={{ position: "sticky", bottom: 0, backgroundColor: "white" }}
        >
          <Grid2 size={2}>
            <Divider />
          </Grid2>

          <Grid2 size={1}>
            <Button
              variant="outlined"
              color="error"
              onClick={() => setOpen(false)}
              fullWidth
            >
              Hủy
            </Button>
          </Grid2>

          <Grid2 size={1}>
            <ButtonLoading
              variant="contained"
              color="primary"
              onClick={handleSave}
              loading={loading}
              fullWidth
            >
              Lưu
            </ButtonLoading>
          </Grid2>
        </Grid2>
      </Grid2>
    </ModalCustom>
  );
};

const Description = ({ description, productId, setProduct }) => {
  const navigate = useNavigate();
  const { enqueueSnackbar } = useSnackbar();

  const [seemore, setSeeMore] = useState(false);
  const [edit, setEdit] = useState(false);
  const [descriptionEdit, setDescriptionEdit] = useState(description);
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    setDescriptionEdit(description);
  }, [description]);

  const handleUpdateDescription = async () => {
    setLoading(true);
    try {
      const response = await axiosWithAuth.put(
        Api.sellerProducts(productId),
        {
          description: descriptionEdit,
        },
        {
          navigate,
        }
      );
      setEdit(false);
      setProduct(response.data);

      enqueueSnackbar("Cập nhật sản phẩm thành công", {
        variant: "success",
      });
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  };

  return (
    <>
      {edit ? (
        <TextField
          multiline
          rows={8}
          value={descriptionEdit}
          sx={{
            width: "100%",
            height: "228px",
            "& textarea": {
              fontSize: "body2.fontSize",
              whiteSpace: "pre-line",
            },
          }}
          onChange={(e) => setDescriptionEdit(e.target.value)}
        />
      ) : (
        <>
          <Typography
            variant="body2"
            className={seemore ? "" : "line-clamp-10"}
            sx={{ whiteSpace: "pre-line" }}
          >
            {description}
          </Typography>
          <Typography
            variant="body2"
            onClick={() => setSeeMore(!seemore)}
            color="primary"
            sx={{
              cursor: "pointer",
              width: "fit-content",
              mt: 1,
            }}
          >
            {seemore ? "Ẩn" : "Xem thêm"}
          </Typography>
        </>
      )}

      <Box sx={{ mt: 1 }}>
        {edit ? (
          <>
            <Button
              variant="outlined"
              size="small"
              color="error"
              onClick={() => setEdit(false)}
            >
              Hủy
            </Button>
            <ButtonLoading
              variant="contained"
              size="small"
              onClick={handleUpdateDescription}
              sx={{ ml: 2 }}
              loading={loading}
            >
              Lưu
            </ButtonLoading>
          </>
        ) : (
          <Button
            variant="outlined"
            size="small"
            sx={{ px: 2 }}
            onClick={() => setEdit(true)}
          >
            Chỉnh sửa
          </Button>
        )}
      </Box>
    </>
  );
};

const ProductDetail = () => {
  const params = useParams();
  const [loading, setLoading] = useState(true);
  const [product, setProduct] = useState(null);
  const [openModal, setOpenModal] = useState(false);
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
        <Box sx={{ width: "100%", mb: 2 }}>
          <Typography
            variant="h6"
            fontWeight={"bold"}
            sx={{ borderBottom: 1, pb: 2 }}
            textAlign={"center"}
          >
            <Skeleton width="70%" sx={{ mx: "auto", height: 40 }} />
          </Typography>

          <TableContainer>
            <Table>
              <TableBody>
                <TableRow>
                  <TableCell width={"120px"}>
                    <Skeleton width="80%" sx={{ height: 32 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton width="40%" sx={{ height: 32 }} />
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
                      <Skeleton
                        variant="rectangular"
                        width={200}
                        height={200}
                        sx={{ mb: 1 }}
                      />
                      <Skeleton width="50%" sx={{ height: 32 }} />
                    </Box>
                  </TableCell>
                </TableRow>

                <TableRow>
                  <TableCell>
                    <Skeleton width="80%" sx={{ height: 32 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton width="60%" sx={{ height: 32 }} />
                  </TableCell>
                </TableRow>

                <TableRow>
                  <TableCell>
                    <Skeleton width="80%" sx={{ height: 32 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton width="80%" sx={{ height: 32 }} />
                  </TableCell>
                </TableRow>

                <TableRow>
                  <TableCell>
                    <Skeleton width="80%" sx={{ height: 32 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton width="70%" sx={{ height: 32 }} />
                    <Skeleton width="50%" sx={{ height: 32 }} />
                    <Skeleton width="90%" sx={{ height: 32 }} />
                  </TableCell>
                </TableRow>

                <TableRow>
                  <TableCell>
                    <Skeleton width="80%" sx={{ height: 32 }} />
                  </TableCell>
                  <TableCell colSpan={2}>
                    <Skeleton height={100} />
                  </TableCell>
                </TableRow>
              </TableBody>
            </Table>
          </TableContainer>
        </Box>
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
                    <TableCell sx={{ pr: 0 }}>
                      <Grid2
                        container
                        spacing={1}
                        columns={5}
                        textAlign={"center"}
                        height={seemore ? "auto" : "200px"}
                        overflow={"hidden"}
                      >
                        <Grid2 size={1}></Grid2>
                        <Grid2 size={1}>Tồn kho</Grid2>
                        <Grid2 size={1}>Đã bán</Grid2>
                        <Grid2 size={1}>Giá</Grid2>
                        <Grid2 size={1}>Giảm giá</Grid2>

                        <Grid2 size={5}>
                          <Divider />
                        </Grid2>

                        {product?.variants &&
                          product.variants.map((variant) => {
                            return (
                              <React.Fragment key={variant.product_variant_id}>
                                <Grid2 size={1}>
                                  {variant.values
                                    .map((value) => value.value)
                                    .join(", ")}
                                </Grid2>
                                <Grid2 size={1}>{variant.quantity}</Grid2>
                                <Grid2 size={1}>{variant.sold_quantity}</Grid2>
                                <Grid2 size={1}>
                                  {Format.formatCurrency(variant.price)}
                                </Grid2>
                                <Grid2 size={1}>
                                  {Format.formatCurrency(
                                    variant.promotion_price
                                  )}
                                </Grid2>

                                <Grid2 size={5}>
                                  <Divider />
                                </Grid2>
                              </React.Fragment>
                            );
                          })}
                      </Grid2>

                      <Typography
                        variant="body2"
                        onClick={() => setSeeMore(!seemore)}
                        color="primary"
                        sx={{
                          cursor: "pointer",
                          width: "fit-content",
                          mt: 1,
                        }}
                      >
                        {seemore ? "Ẩn" : "Xem thêm"}
                      </Typography>

                      <Button
                        variant="outlined"
                        size="small"
                        sx={{ mt: 1, px: 2 }}
                        onClick={() => setOpenModal(true)}
                      >
                        Chỉnh sửa
                      </Button>
                      <ModalUpdateProduct
                        open={openModal}
                        setOpen={setOpenModal}
                        variants={product?.variants}
                        setProduct={setProduct}
                        productId={product?.product_id}
                      />
                    </TableCell>
                  </TableRow>

                  <TableRow>
                    <TableCell>Mô tả</TableCell>
                    <TableCell colSpan={2}>
                      <Description
                        description={product?.description}
                        productId={product?.product_id}
                        setProduct={setProduct}
                      />
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
