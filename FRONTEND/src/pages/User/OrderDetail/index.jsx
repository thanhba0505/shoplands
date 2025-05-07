import { useTheme } from "@emotion/react";
import {
  Box,
  Container,
  Divider,
  Grid2,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
  Typography,
} from "@mui/material";
import { useSnackbar } from "notistack";
import { useCallback, useEffect, useState } from "react";
import { useLocation, useNavigate, useParams } from "react-router-dom";
import ButtonLoading from "~/components/ButtonLoading";
import ConfirmModal from "~/components/ConfirmModal";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
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

const HandleRender = ({ status, orderId, url, createdAt }) => {
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

      navigate(Path.userOrders("detail/" + orderId));
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

const OrderDetail = () => {
  const location = useLocation();
  const params = useParams();
  const navigate = useNavigate();
  const { enqueueSnackbar } = useSnackbar();
  const theme = useTheme();

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
        <>Loading...</>
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
                          {order.from_address.from_address_line},{" "}
                          {order.from_address.from_province_name}
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
                          {order.to_address.to_address_line},{" "}
                          {order.to_address.to_province_name}
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

                      {/* {order.paid === 0 && (
                <Grid2 fontSize={"body2.fontSize"} size={12}>
                  <ButtonLoading
                    size="small"
                    variant="outlined"
                    sx={{ px: 3 }}
                    onClick={handlePayment}
                    loading={paymentLoading}
                  >
                    Thanh toán
                  </ButtonLoading>
                </Grid2>
              )} */}

                      <Grid2 size={12}>
                        <HandleRender
                          // setOrders={setOrders}
                          orderId={order.order_id}
                          url={order?.vnp_url}
                          status={order.current_status}
                          createdAt={order.vnp_created_at}
                        />
                      </Grid2>
                    </Grid2>
                  </PaperCustom>
                </Grid2>

                <Grid2 size={12}>
                  <PaperCustom sx={{ px: 3 }}>
                    <TableContainer sx={{ py: 2 }}>
                      <Table
                        sx={{ borderCollapse: "collapse", border: "none" }}
                      >
                        <TableHead>
                          <TableRow
                            sx={{
                              backgroundColor: theme.custom?.primary.light,
                            }}
                          >
                            <TableCell
                              sx={{ textAlign: "center" }}
                              width={"40%"}
                            >
                              Sản phẩm
                            </TableCell>
                            <TableCell sx={{ textAlign: "center" }}>
                              Phân loại
                            </TableCell>
                            <TableCell sx={{ textAlign: "center" }}>
                              Giá
                            </TableCell>
                            <TableCell sx={{ textAlign: "center" }}>
                              Số lượng
                            </TableCell>
                            <TableCell sx={{ textAlign: "center" }}>
                              Thành tiền
                            </TableCell>
                          </TableRow>
                        </TableHead>
                        <TableBody>
                          {order?.order_items?.map((item) => (
                            <TableRow key={item.product_variant_id}>
                              <TableCell>
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
                                  <Typography
                                    variant="body2"
                                    className="line-clamp-2"
                                  >
                                    {item.product_name}
                                  </Typography>
                                </div>
                              </TableCell>
                              <TableCell sx={{ textAlign: "center" }}>
                                {item.attributes.map((attr) => (
                                  <div key={attr.name}>
                                    {attr.name}: {attr.value}
                                  </div>
                                ))}
                              </TableCell>
                              <TableCell sx={{ textAlign: "center" }}>
                                {Format.formatCurrency(item.price)}
                              </TableCell>
                              <TableCell sx={{ textAlign: "center" }}>
                                {item.quantity}
                              </TableCell>
                              <TableCell sx={{ textAlign: "center" }}>
                                {Format.formatCurrency(
                                  item.price * item.quantity
                                )}
                              </TableCell>
                            </TableRow>
                          ))}
                        </TableBody>
                      </Table>
                    </TableContainer>
                  </PaperCustom>
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
