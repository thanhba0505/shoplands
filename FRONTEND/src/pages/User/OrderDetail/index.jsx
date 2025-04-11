import { Container, Typography } from "@mui/material";
import { useSnackbar } from "notistack";
import { useCallback, useEffect, useState } from "react";
import { useLocation, useNavigate, useParams } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Log from "~/helpers/Log";
import axiosWithAuth from "~/utils/axiosWithAuth";

const OrderDetail = () => {
  const location = useLocation();
  const params = useParams();
  const navigate = useNavigate();
  const { enqueueSnackbar } = useSnackbar();

  useEffect(() => {
    const queryParams = new URLSearchParams(location.search);
    const success = queryParams.get("success");

    if (success === "1") {
      enqueueSnackbar("Đã thanh toán đơn hàng " + params.id, {
        variant: "success",
      });
    } else if (success === "0") {
      enqueueSnackbar("Thanh toán đơn hàng thất bại", {
        variant: "error",
      });
    }
  }, [location.search, enqueueSnackbar, params.id]);

  // fetch order
  const [order, setOrder] = useState({});
  const [loading, setLoading] = useState(true);

  const fetchApi = useCallback(async () => {
    setLoading(true);
    try {
      const response = await axiosWithAuth.get(Api.orders(params.id), {
        navigate,
      });

      setOrder(response.data);
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  }, [navigate, params.id]);

  useEffect(() => {
    fetchApi();
  }, [fetchApi]);

  return (
    <Container maxWidth="lg">
      <PaperCustom sx={{ px: 3 }}>
        <Typography variant="h6" sx={{ mt: 1, mb: 1 }} textAlign={"start"}>
          Chi tiết đơn hàng #{params.id}
        </Typography>
      </PaperCustom>
    </Container>
  );
};

export default OrderDetail;
