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
import React, { useState, useEffect, useCallback } from "react";
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

const HandleRender = ({ status }) => {
  switch (status) {
    case "packing":
      return <AcctionButton title="Đã đóng gói" />;
    case "return-request":
      return (
        <>
          <AcctionButton title="Từ chối" />
          <AcctionButton title="Chấp nhận" />
        </>
      );
    default:
      return <></>;
  }
};

const OrdersTable = React.memo(
  ({ orders }) => {
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
                  <TableRow
                    sx={{ backgroundColor: theme.custom?.primary.light }}
                  >
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
                      {Format.formatOrderStatus(order.latest_status.status)}{" "}
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
                    <TableCell sx={{ fontWeight: "bold" }}>
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
                      Khách hàng thanh toán
                    </TableCell>
                    <TableCell align="center" sx={{ fontWeight: "bold" }}>
                      Doanh thu
                    </TableCell>
                  </TableRow>

                  <TableRow>
                    <TableCell>
                      {Format.formatCurrency(order.subtotal_price)}
                    </TableCell>
                    <TableCell align="center">
                      {Format.formatCurrency(order.discount)}
                    </TableCell>
                    <TableCell align="center">
                      {Format.formatCurrency(order.shipping_fee.price)}
                    </TableCell>
                    <TableCell align="center">
                      {Format.formatCurrency(order.final_price)}
                    </TableCell>
                    <TableCell align="center">
                      {Format.formatCurrency(order.paid)}
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

                        <HandleRender status={order.latest_status.status} />
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
  },
  (prevProps, nextProps) => {
    return (
      JSON.stringify(prevProps.orders) === JSON.stringify(nextProps.orders)
    );
  }
);

OrdersTable.displayName = "OrdersTable";

const Orders = () => {
  const seller_id = useSelector((state) => state.auth?.account?.seller_id);
  const location = useLocation();
  const navigate = useNavigate();

  const value = Path.getElement(location.pathname, 3) ?? "all";

  const [orders, setOrders] = useState([]);
  const [count, setCount] = useState(1);
  const [page, setPage] = useState(0);
  const [rowsPerPage, setRowsPerPage] = useState(10);
  const [loading, setLoading] = useState(true);

  const handleChange = (event, newValue) => {
    navigate(Path.sellerOrders(newValue));
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
              page: page + 1,
            },
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
    [seller_id]
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
              <Tab disabled={loading} label="Chờ đóng gói" value="packing" />
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
        />
      </Box>

      {loading ? (
        <CircularProgressLoading sx={{ height: 300 }} />
      ) : (
        <OrdersTable orders={orders} />
      )}

      {/* Pagination */}
      <TablePagination
        disabled={loading}
        component="div"
        count={count}
        page={page}
        onPageChange={handleChangePage}
        rowsPerPage={rowsPerPage}
        onRowsPerPageChange={handleChangeRowsPerPage}
      />
    </PaperCustom>
  );
};
export default Orders;
