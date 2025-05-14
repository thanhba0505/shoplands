import { useTheme } from "@emotion/react";
import {
  Avatar,
  Box,
  Button,
  Container,
  Divider,
  Grid2,
  IconButton,
  Rating,
  Skeleton,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
  TextField,
  Typography,
} from "@mui/material";
import { useSnackbar } from "notistack";
import React, { useCallback, useEffect, useRef, useState } from "react";
import { useLocation, useNavigate, useParams } from "react-router-dom";
import ButtonLoading from "~/components/ButtonLoading";
import CircularProgressLoading from "~/components/CircularProgressLoading";
import ConfirmModal from "~/components/ConfirmModal";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import CloseIcon from "@mui/icons-material/Close";
import axiosWithAuth from "~/utils/axiosWithAuth";

const AcctionButton = ({
  handleOnClick,
  title,
  sx,
  variant = "contained",
  color = "primary",

  ...props
}) => {
  return (
    <ButtonLoading
      variant={variant}
      color={color}
      sx={{
        px: 6,
        marginLeft: "auto",
        ...sx,
      }}
      onClick={handleOnClick}
      {...props}
    >
      {title}
    </ButtonLoading>
  );
};

const HandleRender = ({ status, orderId, url, createdAt, setOrder }) => {
  const [paymentLoading, setPaymentLoading] = useState(false);
  const [loadingComplete, setLoadingComplete] = useState(false);
  const [loadingDelete, setLoadingDelete] = useState(false);

  const [open, setOpen] = useState(false);

  const [openDelete, setOpenDelete] = useState(false);

  const { enqueueSnackbar } = useSnackbar();
  const navigate = useNavigate();

  const handlePaid = async () => {
    const createdAtDate = new Date(createdAt.replace(" ", "T"));

    const currentDate = new Date();

    // Tính số phút chênh lệch
    const diffInMilliseconds = currentDate - createdAtDate;
    const diffInMinutes = Math.floor(diffInMilliseconds / 1000 / 60); // Chuyển đổi từ milliseconds sang phút

    if (diffInMinutes < 1) {
      window.location.href = url;
    } else {
      setPaymentLoading(true);
      try {
        const response = await axiosWithAuth.post(
          Api.orders("link-payment"),
          {
            order_id: orderId,
          },
          {
            navigate,
          }
        );

        window.location.href = response.data.url;
      } catch (error) {
        Log.error(error.response?.data?.message);
      } finally {
        setPaymentLoading(false);
      }
    }
  };

  const handleComplete = async () => {
    setLoadingComplete(true);
    try {
      const response = await axiosWithAuth.put(
        Api.orders("complete/" + orderId),
        {},
        {
          navigate,
        }
      );

      setOrder((prevOrder) => ({
        ...prevOrder,
        current_status: response.data.current_status,
        current_status_name: response.data.current_status_name,
      }));

      enqueueSnackbar(response.data.message, { variant: "success" });
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoadingComplete(false);
    }
  };

  const handleDelete = async () => {
    setLoadingDelete(true);
    try {
      const response = await axiosWithAuth.put(
        Api.orders("delete/" + orderId),
        {
          navigate,
        }
      );

      // setOrders((prevOrders) =>
      //   prevOrders.filter((order) => order.order_id !== orderId)
      // );

      navigate(Path.userOrders("all"));

      enqueueSnackbar(response.data.message, { variant: "success" });
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoadingDelete(false);
    }
  };

  switch (status) {
    case "unpaid":
      return (
        <Box sx={{ display: "flex", gap: 2 }}>
          <AcctionButton
            variant="outlined"
            color="error"
            loading={loadingDelete}
            onClick={() => setOpenDelete(true)}
            title="Hủy"
            sx={{ px: 4, ml: "" }}
          />

          <AcctionButton
            loading={paymentLoading}
            onClick={handlePaid}
            title="Thanh toán"
            sx={{ px: 4, ml: "" }}
          />

          <ConfirmModal
            modelTitle="Hủy đơn hàng"
            subtitle="Xác nhận hủy đơn hàng này!"
            acceptTitle="Xác nhận"
            open={openDelete}
            setOpen={setOpenDelete}
            loading={loadingDelete}
            handleAccept={async () => {
              await handleDelete();
              setOpenDelete(false);
            }}
          />
        </Box>
      );
    case "delivered":
      return (
        <>
          <AcctionButton
            loading={loadingComplete}
            onClick={() => setOpen(true)}
            title="Đã nhận hàng"
          />

          <ConfirmModal
            modelTitle="Đã nhận hàng"
            subtitle="Bạn xác nhận đã nhận hàng và không thể quay lại!"
            acceptTitle="Xác nhận"
            open={open}
            setOpen={setOpen}
            loading={loadingComplete}
            handleAccept={async () => {
              await handleComplete();
              setOpen(false);
            }}
          />
        </>
      );
    default:
      return <></>;
  }
};

const OrderItem = ({
  item,
  review,
  order_id,
  setReviews,
  loadingReviews,
  status,
}) => {
  const navigate = useNavigate();
  const { enqueueSnackbar } = useSnackbar();

  const [rating, setRating] = useState(null);
  const [comment, setComment] = useState("");
  const [images, setImages] = useState([]);
  const [previewImages, setPreviewImages] = useState([]);
  const fileInputRef = useRef(null);

  const [loading, setLoading] = useState(false);

  useEffect(() => {
    if (review) {
      setRating(review.rating);
    }
  }, [review]);

  useEffect(() => {
    if (review) {
      setComment(review.comment);
    }
  }, [review]);

  const handleImageUpload = (e) => {
    const files = Array.from(e.target.files);

    // Giới hạn số lượng ảnh (có thể điều chỉnh)
    const maxFiles = 5;
    if (files.length + images.length > maxFiles) {
      enqueueSnackbar(`Bạn chỉ có thể tải lên tối đa ${maxFiles} ảnh`, {
        variant: "warning",
      });
      return;
    }

    // Thêm files vào state để gửi lên server
    setImages([...images, ...files]);

    // Tạo preview cho ảnh
    const newPreviewImages = files.map((file) => ({
      file,
      preview: URL.createObjectURL(file),
    }));

    setPreviewImages([...previewImages, ...newPreviewImages]);
  };

  const removeImage = (index) => {
    const newImages = [...images];
    newImages.splice(index, 1);
    setImages(newImages);

    const newPreviewImages = [...previewImages];

    // Xóa object URL để tránh memory leak
    URL.revokeObjectURL(newPreviewImages[index].preview);

    newPreviewImages.splice(index, 1);
    setPreviewImages(newPreviewImages);
  };

  // Xóa object URLs khi component unmount để tránh memory leak
  useEffect(() => {
    return () => {
      previewImages.forEach((image) => URL.revokeObjectURL(image.preview));
    };
  // eslint-disable-next-line react-hooks/exhaustive-deps
  }, []);

  const fetchReview = async () => {
    setLoading(true);

    try {
      // Tạo FormData nếu có ảnh cần upload
      const formData = new FormData();
      formData.append("order_id", order_id);
      formData.append("rating", rating);
      formData.append("comment", comment);
      formData.append("order_item_id", item.order_item_id);

      // Thêm tất cả ảnh vào formData
      images.forEach((image, index) => {
        formData.append(`images[${index}]`, image);
      });

      // Gửi request với FormData
      const response = await axiosWithAuth.post(Api.userReviews(), formData, {
        navigate,
        headers: {
          "Content-Type": "multipart/form-data",
        },
      });

      setReviews((prevReviews) => [...prevReviews, response.data.data]);
      enqueueSnackbar(response.data.message, { variant: "success" });

      // Reset form sau khi gửi thành công
      if (!review) {
        setComment("");
        setRating(null);
        setImages([]);
        setPreviewImages([]);
      }
    } catch (error) {
      Log.error(error.response?.data?.message);
    }

    setLoading(false);
  };
  
  return (
    <>
      <TableRow>
        <TableCell sx={{ border: status === "completed" ? "none" : "" }}>
          <div
            style={{
              display: "flex",
              alignItems: "center",
              gap: "20px",
            }}
          >
            <img
              src={Path.publicProduct(item.image)}
              alt={item.product_name}
              width="50"
            />
            <Typography variant="body2" className="line-clamp-2">
              {item.product_name}
            </Typography>
          </div>
        </TableCell>
        <TableCell
          sx={{
            textAlign: "center",
            border: status === "completed" ? "none" : "",
          }}
        >
          {item.attributes.map((attr) => (
            <div key={attr.name}>
              {attr.name}: {attr.value}
            </div>
          ))}
        </TableCell>
        <TableCell
          sx={{
            textAlign: "center",
            border: status === "completed" ? "none" : "",
          }}
        >
          {Format.formatCurrency(item.price)}
        </TableCell>
        <TableCell
          sx={{
            textAlign: "center",
            border: status === "completed" ? "none" : "",
          }}
        >
          {item.quantity}
        </TableCell>
        <TableCell
          sx={{
            textAlign: "center",
            border: status === "completed" ? "none" : "",
          }}
        >
          {Format.formatCurrency(item.price * item.quantity)}
        </TableCell>
      </TableRow>

      {status === "completed" && (
        <>
          {loadingReviews ? (
            <TableRow>
              <TableCell colSpan={6}>
                <CircularProgressLoading height={150} sx={{ pb: 4 }} />
              </TableCell>
            </TableRow>
          ) : (
            <TableRow>
              <TableCell colSpan={6} sx={{ pt: 0, pb: 4 }}>
                <Grid2 container sx={{ pl: "70px" }} spacing={2}>
                  <Grid2
                    container
                    size={5}
                    spacing={2}
                    flexDirection={"column"}
                  >
                    <Grid2 size={12}>
                      <TextField
                        fullWidth
                        multiline
                        rows={4}
                        variant="outlined"
                        placeholder={
                          review ? "Không có nội dung" : "Đánh giá sản phẩm"
                        }
                        value={comment}
                        onChange={(e) => setComment(e.target.value)}
                        disabled={review ? true : false}
                      />
                    </Grid2>
                    <Grid2>
                      {review ? (
                        <Typography
                          variant="body2"
                          fontStyle={"italic"}
                          color="#BDBDBD"
                        >
                          Đã đánh giá
                        </Typography>
                      ) : (
                        <>
                          <ButtonLoading
                            onClick={fetchReview}
                            loading={loading}
                            variant="contained"
                            size="small"
                            disabled={rating === null}
                          >
                            Gửi đánh giá
                          </ButtonLoading>

                          <Button
                            variant="outlined"
                            color={"error"}
                            size="small"
                            onClick={() => {
                              setComment("");
                              setRating(null);
                              setImages([]);
                              setPreviewImages([]);
                            }}
                            sx={{ ml: 2 }}
                          >
                            Hủy
                          </Button>
                        </>
                      )}
                    </Grid2>
                  </Grid2>
                  <Grid2
                    container
                    spacing={2}
                    size={7}
                    justifyContent={"start"}
                    flexDirection={"column"}
                  >
                    <Grid2 size={12}>
                      <Rating
                        name="simple-controlled"
                        value={rating}
                        onChange={(event, newValue) => {
                          setRating(newValue);
                        }}
                        readOnly={review ? true : false}
                      />
                    </Grid2>

                    <Grid2
                      size={12}
                      sx={{
                        display: "flex",
                        gap: 2,
                        flexWrap: "wrap",
                        alignItems: "end",
                      }}
                    >
                      {/* Hiển thị ảnh đã đánh giá */}
                      {review &&
                        review.image_paths &&
                        review.image_paths.length > 0 &&
                        review.image_paths.map((image, key) => (
                          <React.Fragment key={image.image_path + key}>
                            {image.image_path && (
                              <Avatar
                                src={Path.publicReview(image.image_path)}
                                sx={{ width: 80, height: 80, display: "block" }}
                                variant="rounded"
                              />
                            )}
                          </React.Fragment>
                        ))}

                      {/* Hiển thị preview ảnh người dùng chọn */}
                      {!review &&
                        previewImages.map((image, index) => (
                          <Box key={index} sx={{ position: "relative" }}>
                            <Avatar
                              src={image.preview}
                              sx={{ width: 80, height: 80 }}
                              variant="rounded"
                            />
                            <IconButton
                              sx={{
                                position: "absolute",
                                width: 24,
                                height: 24,
                                top: -8,
                                right: -8,
                                bgcolor: "background.paper",
                                border: 1,
                                boxShadow: 1,
                                "&:hover": { bgcolor: "background.paper" },
                              }}
                              onClick={() => removeImage(index)}
                            >
                              <CloseIcon fontSize="small" />
                            </IconButton>
                          </Box>
                        ))}

                      {/* Nút thêm ảnh */}
                      {!review && (
                        <>
                          <input
                            type="file"
                            multiple
                            accept="image/*"
                            onChange={handleImageUpload}
                            style={{ display: "none" }}
                            ref={fileInputRef}
                          />
                          <Button
                            variant="outlined"
                            onClick={() => fileInputRef.current.click()}
                            // startIcon={<AddPhotoAlternateIcon />}
                          >
                            Thêm ảnh
                          </Button>
                        </>
                      )}
                    </Grid2>
                  </Grid2>
                </Grid2>
              </TableCell>
            </TableRow>
          )}
        </>
      )}
    </>
  );
};

const OrderItems = ({ order_items, order_id, status }) => {
  const theme = useTheme();
  const navigate = useNavigate();
  const [reviews, setReviews] = useState([]);

  const [loading, setLoading] = useState(false);

  const fetchReviews = useCallback(async () => {
    if (status === "completed") {
      setLoading(true);
      try {
        const response = await axiosWithAuth.get(Api.userReviews(order_id), {
          navigate,
        });
        setReviews(response.data);
      } catch (error) {
        Log.error(error.response?.data?.message);
      } finally {
        setLoading(false);
      }
    }
  }, [navigate, order_id, status]);

  useEffect(() => {
    fetchReviews();
  }, [fetchReviews]);

  return (
    <PaperCustom sx={{ px: 3 }}>
      <TableContainer sx={{ py: 2 }}>
        <Table sx={{ borderCollapse: "collapse", border: "none" }}>
          <TableHead>
            <TableRow
              sx={{
                backgroundColor: theme.custom?.primary.light,
              }}
            >
              <TableCell sx={{ textAlign: "center" }} width={"40%"}>
                Sản phẩm
              </TableCell>
              <TableCell sx={{ textAlign: "center" }}>Phân loại</TableCell>
              <TableCell sx={{ textAlign: "center" }}>Giá</TableCell>
              <TableCell sx={{ textAlign: "center" }}>Số lượng</TableCell>
              <TableCell sx={{ textAlign: "center" }}>Thành tiền</TableCell>
            </TableRow>
          </TableHead>
          <TableBody>
            {order_items?.map((item) => (
              <React.Fragment key={item.product_variant_id}>
                <OrderItem
                  item={item}
                  review={reviews.find(
                    (review) =>
                      review.product_variant_id === item.product_variant_id
                  )}
                  order_id={order_id}
                  setReviews={setReviews}
                  loadingReviews={loading}
                  status={status}
                />
              </React.Fragment>
            ))}
          </TableBody>
        </Table>
      </TableContainer>
    </PaperCustom>
  );
};

const OrderDetail = () => {
  const location = useLocation();
  const params = useParams();
  const navigate = useNavigate();
  const { enqueueSnackbar } = useSnackbar();

  useEffect(() => {
    const queryParams = new URLSearchParams(location.search);
    const success = queryParams.get("success");
    const message = queryParams.get("message");

    if (success === "1") {
      enqueueSnackbar(message, {
        variant: "success",
      });
    } else if (success === "0") {
      enqueueSnackbar(message, {
        variant: "error",
      });
    }

    navigate(Path.userOrders("detail/" + params.orderId), { replace: true });
  }, [location.search, enqueueSnackbar, params.orderId, navigate]);

  // fetch order
  const [order, setOrder] = useState(null);
  const [loading, setLoading] = useState(true);

  const fetchApi = useCallback(async () => {
    setLoading(true);
    try {
      const queryParams = new URLSearchParams(location.search);
      const success = queryParams.get("success");
      const message = queryParams.get("message");
      if (!success && !message) {
        const response = await axiosWithAuth.get(Api.orders(params.orderId), {
          navigate,
        });

        setOrder(response.data);
      }
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  }, [navigate, params.orderId, location.search]);

  useEffect(() => {
    fetchApi();
  }, [fetchApi]);

  return (
    <Container maxWidth="lg">
      {loading ? (
        <>
          <Grid2 container spacing={3}>
            <Grid2 size={12} height={68}>
              <PaperCustom sx={{ height: "100%" }}>
                <Skeleton variant="text" />
              </PaperCustom>
            </Grid2>

            <Grid2 size={8} height={280}>
              <PaperCustom sx={{ height: "100%" }}>
                <Skeleton variant="text" sx={{ mt: 1 }} />
                <Skeleton variant="text" sx={{ mt: 1 }} />
                <Divider sx={{ mt: 2, mb: 2 }} />
                <Skeleton variant="text" sx={{ mt: 1, width: "30%" }} />
                <Skeleton variant="text" sx={{ mt: 1, width: "70%" }} />
                <Skeleton variant="text" sx={{ mt: 1, width: "40%" }} />
                <Skeleton variant="text" sx={{ mt: 1, width: "60%" }} />
              </PaperCustom>
            </Grid2>

            <Grid2 size={4} height={280}>
              <PaperCustom sx={{ height: "100%" }}>
                <Skeleton variant="text" sx={{ mt: 1 }} />
                <Skeleton variant="text" sx={{ mt: 2, width: "30%" }} />
                <Skeleton variant="text" sx={{ mt: 2, width: "70%" }} />
                <Skeleton variant="text" sx={{ mt: 2, width: "40%" }} />
                <Skeleton variant="text" sx={{ mt: 2, width: "60%" }} />
              </PaperCustom>
            </Grid2>

            <Grid2 size={12} height={205}>
              <PaperCustom sx={{ height: "100%" }}>
                <Skeleton variant="text" sx={{ mt: 1 }} />
                <Skeleton variant="text" sx={{ mt: 2, width: "30%" }} />
                <Skeleton variant="text" sx={{ mt: 2, width: "70%" }} />
                <Skeleton variant="text" sx={{ mt: 2, width: "40%" }} />
              </PaperCustom>
            </Grid2>
          </Grid2>
        </>
      ) : (
        <>
          {order && (
            <>
              <Grid2 container spacing={3}>
                <Grid2 size={12}>
                  <PaperCustom
                    sx={{
                      px: 3,
                      display: "flex",
                      alignItems: "center",
                      justifyContent: "space-between",
                    }}
                  >
                    <Typography variant="h6" textAlign={"start"}>
                      Chi tiết đơn hàng #{order.order_id}
                    </Typography>
                    {order.ghn_order_code && (
                      <Box
                        sx={{ display: "flex", gap: 1, alignItems: "center" }}
                      >
                        <Typography
                          variant="body2"
                          sx={{ borderRight: "2px solid #ccc", pr: 1 }}
                        >
                          Mã vận chuyển: {order.ghn_order_code}
                        </Typography>
                        <Typography
                          variant="body2"
                          textAlign={"end"}
                          color="primary"
                          sx={{ cursor: "pointer" }}
                          onClick={() =>
                            window.open(order.tracking_url, "_blank")
                          }
                        >
                          Xem chi tiết vận chuyển
                        </Typography>
                      </Box>
                    )}
                  </PaperCustom>
                </Grid2>

                <Grid2 size={8}>
                  <PaperCustom sx={{ px: 3, height: "100%" }}>
                    <Grid2
                      container
                      columnSpacing={4}
                      rowSpacing={3}
                      sx={{ py: 2 }}
                    >
                      <Grid2
                        container
                        size={12}
                        spacing={1}
                        sx={{ borderBottom: "1px solid #ccc", pb: 3 }}
                      >
                        <Grid2 size={12}>
                          <span style={{ fontWeight: "bold" }}>
                            Thời gian đặt hàng:
                          </span>{" "}
                          {Format.formatDateTime(order.created_at)}
                        </Grid2>
                        <Grid2 size={12}>
                          <span style={{ fontWeight: "bold" }}>
                            Trạng thái hiện tại:
                          </span>{" "}
                          {order.current_status_name}
                        </Grid2>
                      </Grid2>

                      <Grid2
                        container
                        spacing={1}
                        size={6}
                        alignItems={"start"}
                      >
                        <Typography
                          variant="body"
                          sx={{ fontWeight: "bold", width: "100%" }}
                        >
                          THÔNG TIN NGƯỜI MUA
                        </Typography>

                        <Grid2 size={12}>
                          <Typography
                            variant="body"
                            sx={{ fontWeight: "bold" }}
                          >
                            Tên:
                          </Typography>{" "}
                          {order.user.name}
                        </Grid2>

                        <Grid2 size={12}>
                          <Typography
                            variant="body"
                            sx={{ fontWeight: "bold" }}
                          >
                            Địa chỉ:
                          </Typography>{" "}
                          {order.to_address.to_address_line},{" "}
                          {order.to_address.to_province_name}
                        </Grid2>
                      </Grid2>

                      <Grid2
                        container
                        spacing={1}
                        size={6}
                        alignItems={"start"}
                      >
                        <Typography
                          variant="body"
                          sx={{ fontWeight: "bold", width: "100%" }}
                        >
                          THÔNG TIN NGƯỜI BÁN
                        </Typography>

                        <Grid2 size={12}>
                          <Typography
                            variant="body"
                            sx={{ fontWeight: "bold" }}
                          >
                            Tên:
                          </Typography>{" "}
                          {order.seller.store_name}
                        </Grid2>

                        <Grid2 size={12}>
                          <Typography
                            variant="body"
                            sx={{ fontWeight: "bold" }}
                          >
                            Địa chỉ:
                          </Typography>{" "}
                          {order.from_address.from_address_line},{" "}
                          {order.from_address.from_province_name}
                        </Grid2>
                      </Grid2>
                    </Grid2>
                  </PaperCustom>
                </Grid2>

                <Grid2 size={4}>
                  <PaperCustom sx={{ px: 3, height: "100%" }}>
                    <Grid2
                      container
                      alignItems={"center"}
                      spacing={2}
                      sx={{ fontSize: "h6.fontSize", py: 2 }}
                      fontSize={"body2.fontSize"}
                    >
                      <Grid2
                        fontSize={"body2.fontSize"}
                        size={6}
                        fontWeight={"bold"}
                      >
                        Tổng tiền sản phẩm:
                      </Grid2>
                      <Grid2 fontSize={"body2.fontSize"} size={6}>
                        {Format.formatCurrency(order.subtotal_price)}
                      </Grid2>

                      <Grid2
                        fontSize={"body2.fontSize"}
                        size={6}
                        fontWeight={"bold"}
                      >
                        Phí vận chuyển:
                      </Grid2>
                      <Grid2 fontSize={"body2.fontSize"} size={6}>
                        {Format.formatCurrency(order.shipping_fee)}
                      </Grid2>

                      <Grid2
                        fontSize={"body2.fontSize"}
                        size={6}
                        fontWeight={"bold"}
                      >
                        Giảm giá:
                      </Grid2>
                      <Grid2 fontSize={"body2.fontSize"} size={6}>
                        {Format.formatCurrency(order.discount)}
                      </Grid2>

                      <Grid2 fontSize={"body2.fontSize"} size={12}>
                        <Divider color="#ccc" />
                      </Grid2>

                      <Grid2
                        fontSize={"body2.fontSize"}
                        size={6}
                        sx={{ fontWeight: "bold" }}
                      >
                        Thành tiền:
                      </Grid2>
                      <Grid2
                        size={6}
                        sx={{
                          fontWeight: "bold",
                          color: "red",
                          fontSize: "h6.fontSize",
                        }}
                      >
                        {Format.formatCurrency(order.final_price)}
                      </Grid2>

                      <Grid2 size={12}>
                        <HandleRender
                          // setOrders={setOrders}
                          orderId={order.order_id}
                          url={order?.vnp_url}
                          status={order.current_status}
                          createdAt={order.vnp_created_at}
                          setOrder={setOrder}
                        />
                      </Grid2>
                    </Grid2>
                  </PaperCustom>
                </Grid2>

                <Grid2 size={12}>
                  <OrderItems
                    order_items={order.order_items}
                    order_id={order.order_id}
                    status={order.current_status}
                  />
                </Grid2>
              </Grid2>
            </>
          )}
        </>
      )}
    </Container>
  );
};

export default OrderDetail;
