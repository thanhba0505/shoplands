import { Box, Container, Typography } from "@mui/material";
import { useSnackbar } from "notistack";
import { useEffect, useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import { useNavigate } from "react-router-dom";
import ButtonLoading from "~/components/ButtonLoading";
import Api from "~/helpers/Api";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import { startLoading, stopLoading } from "~/redux/loadingSlice";
import { reset } from "~/redux/orderSlice";
import axiosWithAuth from "~/utils/axiosWithAuth";

const Payment = () => {
  const navigate = useNavigate();
  const dispatch = useDispatch();
  const { enqueueSnackbar } = useSnackbar();
  const { path_qr, order_id } = useSelector((state) => state.order);

  const [isLoading, setIsLoading] = useState(false);

  useEffect(() => {
    if (!path_qr || !order_id) {
      Path.userOrders("detail/" + order_id);
    }
  }, [path_qr, order_id, navigate]);

  const handleCheckPayment = async () => {
    dispatch(startLoading());
    setIsLoading(true);
    try {
      const response = await axiosWithAuth.post(Api.orders("check-payment"), {
        order_id: order_id,
      });

      enqueueSnackbar(response.data.message, { variant: "success" });
      navigate(Path.userOrders("detail/" + order_id));
      dispatch(reset());
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setIsLoading(false);
      dispatch(stopLoading());
    }
  };

  return (
    <Container>
      <Box sx={{ textAlign: "center" }}>
        <Typography variant="h5">
          Thanh toán theo mã sau để hoàn tất đơn hàng
        </Typography>

        <img src={Path.public(path_qr)} alt="" />
        <Typography variant="subtitle1">
          Lưu ý: không thay đổi nội dung thanh toán
        </Typography>
      </Box>
      <ButtonLoading
        loading={isLoading}
        variant="contained"
        onClick={handleCheckPayment}
      >
        Xác nhận đã thanh toán
      </ButtonLoading>
    </Container>
  );
};

export default Payment;
