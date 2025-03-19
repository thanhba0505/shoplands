import { Table, TableBody, TableCell, TableContainer, TableHead, TableRow, TableFooter, Paper, Typography, Box, Button } from '@mui/material';
import { useState, useEffect, useCallback } from 'react';
import { useSelector } from 'react-redux';
import axiosWithAuth from '~/utils/axiosWithAuth';
import Api from '~/helpers/Api';
import Log from '~/helpers/Log';
import PaperCustom from '~/components/PaperCustom';
import Path from '~/helpers/Path';
import { useTheme } from '@emotion/react';
import Format from '~/helpers/Format';
import ButtonLoading from '~/components/ButtonLoading';

const Orders = () => {
  const theme = useTheme();
  const seller_id = useSelector((state) => state.auth?.account?.seller_id);

  const [orders, setOrders] = useState([]);

  const fetchApi = useCallback(async () => {
    try {
      if (seller_id) {
        const response = await axiosWithAuth.get(Api.sellerOrders());
        setOrders(response.data);
      }
    } catch (error) {
      Log.error(error.response?.data?.message);
    }
  }, [seller_id]);

  useEffect(() => {
    fetchApi();
  }, [seller_id, fetchApi]);

  return (
    <PaperCustom>
      {orders.map((order) => (
        <TableContainer key={order.order_id} component={Paper} sx={{ marginBottom: '20px' }}>
          <Table>
            <TableHead>
              <TableRow sx={{ backgroundColor: theme.custom?.primary.light }}>
                <TableCell>Mã Đơn Hàng: {order.order_id}</TableCell>
                <TableCell align='center'>{order.user.name}</TableCell>
                <TableCell align='center'>{order.to_address.province_name}</TableCell>
                <TableCell align='center'>{order.shipping_fee.method}</TableCell>
                <TableCell align='center'>{Format.formatOrderStatus(order.latest_status.status)}</TableCell>
              </TableRow>
            </TableHead>

            <TableBody>
              {order.order_items.map((item) => (
                <TableRow key={item.order_item_id}>
                  <TableCell colSpan={2} sx={{ maxWidth: '200px' }}>
                    <div style={{ display: 'flex', alignItems: 'center', gap: '20px' }} >
                      <img src={Path.publicProduct(item.image)} alt={item.product.name} width="50" />
                      <Typography variant="body2" className='line-clamp-2'>{item.product.name}</Typography>
                    </div>
                  </TableCell>
                  <TableCell align='center'>Số lượng: {item.quantity}</TableCell>
                  <TableCell align='center'>{Format.formatCurrency(item.price)}</TableCell>
                  <TableCell align='center'>
                    {item.attributes.map((attr) => (
                      <div key={attr.name}>
                        {attr.name}: {attr.value}
                      </div>
                    ))}
                  </TableCell>
                </TableRow>
              ))}

              <TableRow>
                <TableCell sx={{ fontWeight: "bold" }}>Tổng giá sản phẩm</TableCell>
                <TableCell align='center' sx={{ fontWeight: "bold" }}>Tổng giảm giá</TableCell>
                <TableCell align='center' sx={{ fontWeight: "bold" }}>Thành tiền đơn hàng</TableCell>
                <TableCell align='center' sx={{ fontWeight: "bold" }}>Khách hàng thanh toán</TableCell>
                <TableCell align='center' sx={{ fontWeight: "bold" }}>Doanh thu</TableCell>
              </TableRow>

              <TableRow>
                <TableCell>{Format.formatCurrency(order.subtotal_price)}</TableCell>
                <TableCell align='center'>{Format.formatCurrency(order.discount)}</TableCell>
                <TableCell align='center'>{Format.formatCurrency(order.final_price)}</TableCell>
                <TableCell align='center'>{Format.formatCurrency(order.paid)}</TableCell>
                <TableCell align='center'>{Format.formatCurrency(order.revenue)}</TableCell>
              </TableRow>

              <TableRow>
                <TableCell colSpan={5} align="right">
                  <Box px={4}>
                    <ButtonLoading variant="outlined" sx={{ backgroundColor: theme.custom?.primary.strongLight }} >accout</ButtonLoading>
                  </Box>
                </TableCell>
              </TableRow>
            </TableBody>
          </Table>
        </TableContainer>
      ))
      }
    </PaperCustom >
  );
};

export default Orders;
