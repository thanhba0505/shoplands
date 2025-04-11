import { useTheme } from "@emotion/react";
import {
  Box,
  Container,
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
import PaperCustom from "~/components/PaperCustom";
import StepCustom from "~/components/StepCustom";
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
    <Container maxWidth="xl">
      {loading ? (
        <>Loading...</>
      ) : (
        <Grid2 container spacing={2}>
          <Grid2 size={12}>
            <PaperCustom sx={{ px: 3 }}>
              <Typography variant="h6" textAlign={"start"}>
                Chi tiết đơn hàng #{params.id}
              </Typography>
            </PaperCustom>
          </Grid2>

          <Grid2 size={8}>
            <PaperCustom sx={{ px: 3 }}>
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
                    
                  </TableBody>
                </Table>
              </TableContainer>
            </PaperCustom>
          </Grid2>

          <Grid2 size={4}>
            <PaperCustom sx={{ px: 3 }}>Người mua</PaperCustom>
          </Grid2>

          <Grid2 size={12}>
            <PaperCustom sx={{ px: 3 }}>
              <StepCustom />
            </PaperCustom>
          </Grid2>

          <Grid2 size={12}>
            <PaperCustom sx={{ px: 3 }}>Thông tin thanh toán</PaperCustom>
          </Grid2>
        </Grid2>
      )}
    </Container>
  );
};

export default OrderDetail;
