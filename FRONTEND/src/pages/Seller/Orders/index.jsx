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
import { useNavigate, useParams } from "react-router-dom";

const OrdersTable = ({ orders }) => {
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
                    {order.from_address.province_name}
                  </TableCell>
                  <TableCell align="center">
                    Đến: <br />
                    {order.to_address.province_name}
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
                  <TableCell align="center" sx={{ fontWeight: "bold" }}>
                    Thành tiền đơn hàng
                  </TableCell>
                  <TableCell align="center" sx={{ fontWeight: "bold" }}>
                    Trạng thái thanh toán
                  </TableCell>
                  <TableCell align="center" sx={{ fontWeight: "bold" }}>
                    Doanh thu
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
                  <TableCell align="center">
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
                  <TableCell align="center">
                    {Format.formatCurrency(order.revenue)}
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
  const seller_id = useSelector((state) => state.auth?.account?.seller_id);
  const navigate = useNavigate();
  const params = useParams();

  const value = params.status ?? "all";

  const [orders, setOrders] = useState([]);
  const [count, setCount] = useState(0);
  const [page, setPage] = useState(0);
  const [rowsPerPage, setRowsPerPage] = useState(10);
  const [loading, setLoading] = useState(false);

  const handleChange = (event, newValue) => {
    navigate(Path.sellerOrders(newValue));
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
        if (seller_id) {
          const response = await axiosWithAuth.get(Api.sellerOrders(), {
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
    [seller_id, navigate]
  );

  useEffect(() => {
    fetchApi(value, page, rowsPerPage);
  }, [seller_id, value, page, rowsPerPage, fetchApi]);

  return (
    <PaperCustom>
      <Box sx={{ width: "100%", typography: "body1" }}>
        <TabContext value={value}>
          <Box sx={{ borderBottom: 1, borderColor: "divider" }}>
            <TabList onChange={handleChange} aria-label="lab API tabs example">
              <Tab disabled={loading} label="Tất cả" value="all" />
              <Tab disabled={loading} label="Chờ giao hàng" value="waiting" />
              <Tab disabled={loading} label="Đang giao hàng" value="shipping" />
              <Tab disabled={loading} label="Đã giao hàng" value="completed" />
              <Tab disabled={loading} label="Đơn hàng trả" value="return" />
              <Tab disabled={loading} label="Đơn hàng khác" value="other" />
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
