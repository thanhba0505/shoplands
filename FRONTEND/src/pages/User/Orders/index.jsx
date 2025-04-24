import {
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
  TableFooter,
  Paper,
  Typography,
  Box,
  Tab,
  TablePagination,
  TextField,
  Skeleton,
} from "@mui/material";
import { useState, useEffect, useCallback } from "react";
import { useSelector } from "react-redux";
import axiosWithAuth from "~/utils/axiosWithAuth";
import Api from "~/helpers/Api";
import Log from "~/helpers/Log";
import PaperCustom from "~/components/PaperCustom";
import Path from "~/helpers/Path";
import { useTheme } from "@mui/material/styles";
import Format from "~/helpers/Format";
import ButtonLoading from "~/components/ButtonLoading";
import { TabContext, TabList } from "@mui/lab";
import NoContent from "~/components/NoContent";
import { useNavigate, useParams } from "react-router-dom";
import { useSnackbar } from "notistack";

const AcctionButton = ({ handleOnClick, title, ...props }) => {
  return (
    <ButtonLoading
      variant="outlined"
      sx={{
        px: 6,
        marginLeft: "auto",
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

  switch (status) {
    case "unpaid":
      return (
        <AcctionButton
          loading={paymentLoading}
          onClick={handlePaid}
          title="Thanh toán"
        />
      );
    case "delivered":
      return (
        <>
          <AcctionButton
            loading={loadingComplete}
            onClick={handleComplete}
            title="Đã nhận hàng"
          />
        </>
      );
    default:
      return <></>;
  }
};

const OrdersTable = ({ orders, setOrders }) => {
  const theme = useTheme();
  const navigate = useNavigate();

  return (
    <>
      {orders && orders.length > 0 ? (
        orders.map((order) => (
          <TableContainer
            key={order.order_id}
            component={Paper}
            sx={{ marginBottom: "20px" }}
          >
            <Table>
              <TableHead>
                <TableRow sx={{ backgroundColor: theme.custom?.primary.light }}>
                  <TableCell align="center">
                    Mã Đơn Hàng: {order.order_id} <br />
                    {Format.formatDateTime(order.created_at)}
                  </TableCell>
                  <TableCell align="center">
                    Khách hàng <br />
                    {order.user.name}
                  </TableCell>
                  <TableCell align="center">
                    Gửi từ: <br />
                    {order.from_address.from_province_name}
                  </TableCell>
                  <TableCell align="center">
                    Đến: <br />
                    {order.to_address.to_province_name}
                  </TableCell>
                  <TableCell align="center">
                    Phương thức giao hàng: <br />
                    Giao hàng nhanh
                  </TableCell>
                  <TableCell align="center">
                    {order.current_status_name}
                    <br />
                    {Format.formatDateTime(order.created_at)}
                  </TableCell>
                </TableRow>
              </TableHead>

              <TableBody>
                {order.order_items.map((item) => (
                  <TableRow key={item.order_item_id}>
                    <TableCell colSpan={3} sx={{ maxWidth: "200px" }}>
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
                    <TableCell align="center">
                      Số lượng: {item.quantity}
                    </TableCell>
                    <TableCell align="center">
                      {Format.formatCurrency(item.price)}
                    </TableCell>
                    <TableCell align="center">
                      {item.attributes.map((attr) => (
                        <div key={attr.name}>
                          {attr.name}: {attr.value}
                        </div>
                      ))}
                    </TableCell>
                  </TableRow>
                ))}

                <TableRow>
                  <TableCell align="center" sx={{ fontWeight: "bold" }}>
                    Tổng giá sản phẩm
                  </TableCell>
                  <TableCell align="center" sx={{ fontWeight: "bold" }}>
                    Tổng giảm giá
                  </TableCell>
                  <TableCell align="center" sx={{ fontWeight: "bold" }}>
                    Phí vận chuyển
                  </TableCell>
                  <TableCell
                    colSpan={2}
                    align="center"
                    sx={{ fontWeight: "bold" }}
                  >
                    Thành tiền đơn hàng
                  </TableCell>
                  <TableCell align="center" sx={{ fontWeight: "bold" }}>
                    Trạng thái thanh toán
                  </TableCell>
                </TableRow>

                <TableRow>
                  <TableCell align="center">
                    {Format.formatCurrency(order.subtotal_price)}
                  </TableCell>
                  <TableCell align="center">
                    {Format.formatCurrency(order.discount)}
                  </TableCell>
                  <TableCell align="center">
                    {Format.formatCurrency(order.shipping_fee)}
                  </TableCell>
                  <TableCell colSpan={2} align="center">
                    <Typography
                      variant="h6"
                      sx={{ fontWeight: "bold" }}
                      lineHeight={1}
                      color="red"
                    >
                      {Format.formatCurrency(order.final_price)}
                    </Typography>
                  </TableCell>
                  <TableCell align="center">
                    {order.paid ? "Đã thanh toán" : "Chưa thanh toán"}
                  </TableCell>
                </TableRow>
              </TableBody>

              <TableFooter>
                <TableRow>
                  <TableCell colSpan={6}>
                    <Box sx={{ display: "flex", gap: 2 }}>
                      <ButtonLoading
                        variant="outlined"
                        sx={{
                          px: 6,
                        }}
                        onClick={() =>
                          navigate(Path.userOrders("detail/") + order.order_id)
                        }
                      >
                        Chi tiết đơn hàng
                      </ButtonLoading>

                      <HandleRender
                        setOrders={setOrders}
                        orderId={order.order_id}
                        url={order?.vnp_url}
                        status={order.current_status}
                        createdAt={order.vnp_created_at}
                      />
                    </Box>
                  </TableCell>
                </TableRow>
              </TableFooter>
            </Table>
          </TableContainer>
        ))
      ) : (
        <NoContent text="Không có đơn hàng" sx={{ height: 300 }} />
      )}
    </>
  );
};

const Orders = () => {
  const user_id = useSelector((state) => state.auth?.account?.user_id);
  const navigate = useNavigate();
  const params = useParams();
  const theme = useTheme();

  const value = params.status || "all";

  const [orders, setOrders] = useState([]);
  const [count, setCount] = useState(0);
  const [page, setPage] = useState(0);
  const [rowsPerPage, setRowsPerPage] = useState(10);
  const [loading, setLoading] = useState(false);

  // Kiểm tra params.status trước khi thực hiện navigate
  useEffect(() => {
    const validStatuses = [
      "all",
      "unpaid",
      "waiting",
      "shipping",
      "completed",
      "return",
      "other",
    ];

    if (!validStatuses.includes(value)) {
      navigate(Path.userOrders("all"));
    }
  }, [value, navigate]);

  const handleChange = (event, newValue) => {
    navigate(Path.userOrders(newValue));
    setOrders([]);
    fetchApi(newValue, page, rowsPerPage);
  };

  const handleChangePage = (event, newPage) => {
    setPage(newPage);
    fetchApi(value, newPage, rowsPerPage);
  };

  const handleChangeRowsPerPage = (event) => {
    const newRowsPerPage = parseInt(event.target.value, 10);
    setRowsPerPage(newRowsPerPage);
    setPage(0);
    fetchApi(value, 0, newRowsPerPage);
  };

  const fetchApi = useCallback(
    async (status = "all", page = 0, limit = 10) => {
      setLoading(true);
      try {
        if (user_id) {
          const response = await axiosWithAuth.get(Api.orders(), {
            params: {
              status: status,
              limit: limit,
              page: page,
            },
            navigate,
          });
          setOrders(response.data.orders);
          setCount(response.data.count);
        }
      } catch (error) {
        Log.error(error.response?.data?.message);
      } finally {
        setLoading(false);
      }
    },
    [user_id, navigate]
  );

  useEffect(() => {
    fetchApi(value, page, rowsPerPage);
  }, [user_id, value, page, rowsPerPage, fetchApi]);

  return (
    <PaperCustom sx={{ px: 3 }}>
      <Box sx={{ width: "100%", typography: "body1" }}>
        <TabContext value={value}>
          <Box sx={{ borderBottom: 1, borderColor: "divider" }}>
            <TabList onChange={handleChange} aria-label="lab API tabs example">
              <Tab disabled={loading} label="Tất cả" value="all" />
              <Tab disabled={loading} label="Chưa thanh toán" value="unpaid" />
              <Tab disabled={loading} label="Chờ giao hàng" value="waiting" />
              <Tab disabled={loading} label="Đang giao hàng" value="shipping" />
              <Tab disabled={loading} label="Đã hoàn thành" value="completed" />
              <Tab disabled={loading} label="Đơn hoàn trả" value="return" />
              <Tab disabled={loading} label="Đơn khác" value="other" />
            </TabList>
          </Box>
        </TabContext>
      </Box>

      <Box
        sx={{
          display: "flex",
          justifyContent: "space-between",
          gap: 2,
          alignItems: "center",
          py: 2,
        }}
      >
        <TextField
          size="small"
          label="Tìm kiếm đơn hàng"
          autoComplete="off"
          variant="outlined"
          sx={{ width: 500 }}
        />

        <TablePagination
          disabled={loading}
          component="div"
          count={count}
          page={page}
          onPageChange={handleChangePage}
          rowsPerPage={rowsPerPage}
          onRowsPerPageChange={handleChangeRowsPerPage}
          labelRowsPerPage="Số dòng mỗi trang"
          labelDisplayedRows={({ from, to, count }) =>
            `${from}-${to} trên ${count}`
          }
        />
      </Box>

      {loading ? (
        <TableContainer component={Paper} sx={{ marginBottom: "20px" }}>
          <Table>
            <TableHead>
              <TableRow sx={{ backgroundColor: theme.custom?.primary.light }}>
                <TableCell align="center">
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
                <TableCell align="center">
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
                <TableCell align="center">
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
                <TableCell align="center">
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
                <TableCell align="center">
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
                <TableCell align="center">
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
              </TableRow>
            </TableHead>

            <TableBody>
              <TableRow>
                <TableCell colSpan={3} sx={{ maxWidth: "200px" }}>
                  <div
                    style={{
                      display: "flex",
                      alignItems: "center",
                      gap: "20px",
                    }}
                  >
                    <Skeleton variant="rounded" height={50} width={50} />
                    <Skeleton height={36} sx={{ flex: 1 }} />
                  </div>
                </TableCell>
                <TableCell align="center">
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
                <TableCell align="center">
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
                <TableCell align="center">
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
              </TableRow>

              <TableRow>
                <TableCell align="center" sx={{ fontWeight: "bold" }}>
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
                <TableCell align="center" sx={{ fontWeight: "bold" }}>
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
                <TableCell align="center" sx={{ fontWeight: "bold" }}>
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
                <TableCell align="center" sx={{ fontWeight: "bold" }}>
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
                <TableCell align="center" sx={{ fontWeight: "bold" }}>
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
                <TableCell align="center" sx={{ fontWeight: "bold" }}>
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
              </TableRow>

              <TableRow>
                <TableCell align="center">
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
                <TableCell align="center">
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
                <TableCell align="center">
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
                <TableCell align="center">
                  <Typography
                    variant="h6"
                    sx={{ fontWeight: "bold" }}
                    lineHeight={1}
                    color="red"
                  >
                    <Skeleton height={36} width={"auto"} />
                  </Typography>
                </TableCell>
                <TableCell align="center">
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
                <TableCell align="center">
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
              </TableRow>
            </TableBody>

            <TableFooter>
              <TableRow>
                <TableCell colSpan={6}>
                  <Skeleton height={36} width={"auto"} />
                </TableCell>
              </TableRow>
            </TableFooter>
          </Table>
        </TableContainer>
      ) : (
        <OrdersTable orders={orders} setOrders={setOrders} />
      )}

      <TablePagination
        disabled={loading}
        component="div"
        count={count}
        page={page}
        onPageChange={handleChangePage}
        rowsPerPage={rowsPerPage}
        onRowsPerPageChange={handleChangeRowsPerPage}
        labelRowsPerPage="Số dòng mỗi trang"
        labelDisplayedRows={({ from, to, count }) =>
          `${from}-${to} trên ${count}`
        }
      />
    </PaperCustom>
  );
};

export default Orders;
