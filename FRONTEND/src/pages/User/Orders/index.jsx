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
import CircularProgressLoading from "~/components/CircularProgressLoading";
import NoContent from "~/components/NoContent";
import { useLocation, useNavigate } from "react-router-dom";
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

const HandleRender = ({ status, orderId, setOrders }) => {
  const [loading, setLoading] = useState(false);
  const { enqueueSnackbar } = useSnackbar();
  const navigate = useNavigate();

  const handlePaid = async () => {
    // setLoading(true);
    // try {
    //   const response = await axiosWithAuth.post(
    //     Api.sellerOrders(orderId),
    //     {},
    //     {
    //       navigate,
    //     }
    //   );
    //   if (response.status === 200) {
    //     setOrders((prevOrders) =>
    //       prevOrders.map((order) =>
    //         order.order_id === orderId
    //           ? { ...order, latest_status: response.data }
    //           : order
    //       )
    //     );
    //     enqueueSnackbar("Đã đóng gói đơn hàng " + orderId, {
    //       variant: "success",
    //     });
    //   }
    // } catch (error) {
    //   Log.error(error.response?.data?.message);
    // } finally {
    //   setLoading(false);
    // }
  };

  const handleComplete = async () => {
    setLoading(true);
    try {
      const response = await axiosWithAuth.post(
        Api.orders(orderId),
        {},
        {
          navigate,
        }
      );
      if (response.status === 200) {
        setOrders((prevOrders) =>
          prevOrders.map((order) =>
            order.order_id === orderId
              ? { ...order, latest_status: response.data }
              : order
          )
        );
        enqueueSnackbar("Đã xác nhận nhận hàng " + orderId, {
          variant: "success",
        });
      }
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  };

  switch (status) {
    case "unpaid":
      return (
        <AcctionButton
          loading={loading}
          onClick={handlePaid}
          title="Thanh toán"
        />
      );
    case "delivered":
      return (
        <>
          <AcctionButton
            loading={loading}
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
                  <TableCell>
                    Mã Đơn Hàng: {order.order_id} <br />
                    {Format.formatDateTime(order.created_at)}
                  </TableCell>
                  <TableCell align="center">
                    Khách hàng <br />
                    {order.user.name}
                  </TableCell>
                  <TableCell align="center">
                    Gửi từ: <br />
                    {order.from_address.province_name}
                  </TableCell>
                  <TableCell align="center">
                    Đến: <br />
                    {order.to_address.province_name}
                  </TableCell>
                  <TableCell align="center">
                    Phương thức giao hàng: <br />
                    {order.shipping_fee.method}
                  </TableCell>
                  <TableCell align="center">
                    {Format.formatOrderStatus(order.latest_status.status)}
                    <br />
                    {Format.formatDateTime(order.latest_status.created_at)}
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
                          alt={item.product.name}
                          width="50"
                        />
                        <Typography variant="body2" className="line-clamp-2">
                          {item.product.name}
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
                    Đã thanh toán
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
                    {Format.formatCurrency(order.shipping_fee.price)}
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
                    {Format.formatCurrency(order.paid)}
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
                      >
                        Chi tiết đơn hàng
                      </ButtonLoading>

                      <HandleRender
                        setOrders={setOrders}
                        orderId={order.order_id}
                        status={order.latest_status.status}
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
  const location = useLocation();
  const navigate = useNavigate();

  const value = Path.getElement(location.pathname, 3) ?? "all";

  const [orders, setOrders] = useState([]);
  const [count, setCount] = useState(1);
  const [page, setPage] = useState(0);
  const [rowsPerPage, setRowsPerPage] = useState(10);
  const [loading, setLoading] = useState(false);

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
              page: page + 1,
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
              <Tab disabled={loading} label="Đang đóng gói" value="packing" />
              <Tab disabled={loading} label="Đã đóng gói" value="packed" />
              <Tab disabled={loading} label="Đang giao hàng" value="shipping" />
              <Tab disabled={loading} label="Đã giao hàng" value="delivered" />
              <Tab disabled={loading} label="Hoàn thành" value="completed" />
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
        <CircularProgressLoading sx={{ height: 300 }} />
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
