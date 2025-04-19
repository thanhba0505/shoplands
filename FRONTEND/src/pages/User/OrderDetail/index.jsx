import { useTheme } from "@emotion/react";
import {
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
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import axiosWithAuth from "~/utils/axiosWithAuth";

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
  const [order, setOrder] = useState({});
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

  const [paymentLoading, setPaymentLoading] = useState(false);

  const handlePayment = async () => {
    const createdAt = order.vnp_created_at;
    const createdAtDate = new Date(createdAt.replace(" ", "T"));

    const currentDate = new Date();

    // Tính số phút chênh lệch
    const diffInMilliseconds = currentDate - createdAtDate;
    const diffInMinutes = Math.floor(diffInMilliseconds / 1000 / 60); // Chuyển đổi từ milliseconds sang phút

    if (diffInMinutes < 10) {
      window.location.href = order.vnp_url;
    } else {
      setPaymentLoading(true);
      try {
        const response = await axiosWithAuth.post(
          Api.orders("link-payment"),
          {
            order_id: params.orderId,
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

  return (
    <Container maxWidth="lg">
      {loading ? (
        <>Loading...</>
      ) : (
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
                Chi tiết đơn hàng #{order.order_id} -{" "}
                {order.current_status_name}
              </Typography>
              {order.tracking_url && (
                <Typography
                  variant="body2"
                  textAlign={"end"}
                  color="primary"
                  sx={{ cursor: "pointer" }}
                  onClick={() => window.open(order.tracking_url, "_blank")}
                >
                  Xem chi tiết vận chuyển
                </Typography>
              )}
            </PaperCustom>
          </Grid2>

          <Grid2 size={8}>
            <PaperCustom sx={{ px: 3, height: "100%" }}>
              <TableContainer sx={{ py: 2 }}>
                <Table sx={{ borderCollapse: "collapse", border: "none" }}>
                  <TableHead>
                    <TableRow
                      sx={{ backgroundColor: theme.custom?.primary.light }}
                    >
                      <TableCell sx={{ textAlign: "center" }} width={"40%"}>
                        Sản phẩm
                      </TableCell>
                      <TableCell sx={{ textAlign: "center" }}>
                        Phân loại
                      </TableCell>
                      <TableCell sx={{ textAlign: "center" }}>Giá</TableCell>
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
                              alt={item.product.name}
                              width="50"
                            />
                            <Typography
                              variant="body2"
                              className="line-clamp-2"
                            >
                              {item.product.name}
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
                          {Format.formatCurrency(item.price * item.quantity)}
                        </TableCell>
                      </TableRow>
                    ))}
                  </TableBody>
                </Table>
              </TableContainer>
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
                <Grid2 fontSize={"body2.fontSize"} size={6} fontWeight={"bold"}>
                  Tổng tiền sản phẩm:
                </Grid2>
                <Grid2 fontSize={"body2.fontSize"} size={6}>
                  {Format.formatCurrency(order.subtotal_price)}
                </Grid2>

                <Grid2 fontSize={"body2.fontSize"} size={6} fontWeight={"bold"}>
                  Phí vận chuyển:
                </Grid2>
                <Grid2 fontSize={"body2.fontSize"} size={6}>
                  {Format.formatCurrency(order.shipping_fee)}
                </Grid2>

                <Grid2 fontSize={"body2.fontSize"} size={6} fontWeight={"bold"}>
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

                {order.paid === 0 && (
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
                )}
              </Grid2>
            </PaperCustom>
          </Grid2>

          <Grid2 size={12}>
            <PaperCustom sx={{ px: 3 }}></PaperCustom>
          </Grid2>
        </Grid2>
      )}
    </Container>
  );
};

export default OrderDetail;
