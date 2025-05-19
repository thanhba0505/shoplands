import { Grid2, Skeleton, Typography } from "@mui/material";
import PaperCustom from "~/components/PaperCustom";
import MonthlyOrderChart from "./MonthlyOrderChart";
import Log from "~/helpers/Log";
import axiosWithAuth from "~/utils/axiosWithAuth";
import Api from "~/helpers/Api";
import { useCallback, useEffect, useState } from "react";
import Format from "~/helpers/Format";

const Dashboard = () => {
  const today = new Date();
  const currentYear = today.getFullYear();
  const currentMonth = today.getMonth();
  const lastMonth = new Date(currentYear, currentMonth, 0);
  const month = (lastMonth.getMonth() + 1).toString().padStart(2, "0");

  const [loading, setLoading] = useState(true);
  const [data, setData] = useState([]);

  const fetchApi = useCallback(async () => {
    setLoading(true);
    try {
      const response = await axiosWithAuth.get(Api.adminDashboard());

      setData(response.data);
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => {
    fetchApi();
  }, [fetchApi]);

  return (
    <Grid2 container spacing={3}>
      <Grid2 size={4}>
        <PaperCustom sx={{ px: 3 }}>
          {loading ? (
            <>
              <Skeleton
                variant="text"
                width={"60%"}
                sx={{ pb: 2, mt: 1, fontSize: "h6.fontSize", mx: "auto" }}
              />
              <Skeleton
                width={"40%"}
                sx={{ pb: 2, mt: 1, fontSize: "h5.fontSize", mx: "auto" }}
              />
            </>
          ) : (
            <>
              <Typography
                variant="h6"
                fontWeight={"bold"}
                textAlign={"center"}
                sx={{ pb: 2, mt: 1 }}
              >
                Tổng tiền
              </Typography>
              <Typography
                variant="h5"
                fontWeight={"bold"}
                textAlign={"center"}
                color="red"
                sx={{ pb: 2, mt: 1 }}
              >
                {Format.formatCurrency(data?.total_coin)}
              </Typography>
            </>
          )}
        </PaperCustom>
      </Grid2>

      <Grid2 size={4}>
        <PaperCustom sx={{ px: 3 }}>
          {loading ? (
            <>
              <Skeleton
                variant="text"
                width={"60%"}
                sx={{ pb: 2, mt: 1, fontSize: "h6.fontSize", mx: "auto" }}
              />
              <Skeleton
                width={"40%"}
                sx={{ pb: 2, mt: 1, fontSize: "h5.fontSize", mx: "auto" }}
              />
            </>
          ) : (
            <>
              <Typography
                variant="h6"
                fontWeight={"bold"}
                textAlign={"center"}
                sx={{ pb: 2, mt: 1 }}
              >
                Phải trả người bán
              </Typography>
              <Typography
                variant="h5"
                fontWeight={"bold"}
                textAlign={"center"}
                color="red"
                sx={{ pb: 2, mt: 1 }}
              >
                {Format.formatCurrency(data?.total_coin_seller)}
              </Typography>
            </>
          )}
        </PaperCustom>
      </Grid2>

      <Grid2 size={4}>
        <PaperCustom sx={{ px: 3 }}>
          {loading ? (
            <>
              <Skeleton
                variant="text"
                width={"60%"}
                sx={{ pb: 2, mt: 1, fontSize: "h6.fontSize", mx: "auto" }}
              />
              <Skeleton
                width={"40%"}
                sx={{ pb: 2, mt: 1, fontSize: "h5.fontSize", mx: "auto" }}
              />
            </>
          ) : (
            <>
              <Typography
                variant="h6"
                fontWeight={"bold"}
                textAlign={"center"}
                sx={{ pb: 2, mt: 1 }}
              >
                Lợi nhận
              </Typography>
              <Typography
                variant="h5"
                fontWeight={"bold"}
                textAlign={"center"}
                color="red"
                sx={{ pb: 2, mt: 1 }}
              >
                {Format.formatCurrency(data?.total_coin_admin)}
              </Typography>
            </>
          )}
        </PaperCustom>
      </Grid2>

      <Grid2 size={4}>
        <PaperCustom sx={{ px: 3 }}>
          {loading ? (
            <>
              <Skeleton
                variant="text"
                width={"60%"}
                sx={{ pb: 2, mt: 1, fontSize: "h6.fontSize", mx: "auto" }}
              />
              <Skeleton
                width={"40%"}
                sx={{ pb: 2, mt: 1, fontSize: "h5.fontSize", mx: "auto" }}
              />
            </>
          ) : (
            <>
              <Typography
                variant="h6"
                fontWeight={"bold"}
                textAlign={"center"}
                sx={{ pb: 2, mt: 1 }}
              >
                Tổng số người bán
              </Typography>
              <Typography
                variant="h5"
                fontWeight={"bold"}
                textAlign={"center"}
                color="red"
                sx={{ pb: 2, mt: 1 }}
              >
                {Format.formatNumber(data?.count_seller)}
              </Typography>
            </>
          )}
        </PaperCustom>
      </Grid2>

      <Grid2 size={4}>
        <PaperCustom sx={{ px: 3 }}>
          {loading ? (
            <>
              <Skeleton
                variant="text"
                width={"60%"}
                sx={{ pb: 2, mt: 1, fontSize: "h6.fontSize", mx: "auto" }}
              />
              <Skeleton
                width={"40%"}
                sx={{ pb: 2, mt: 1, fontSize: "h5.fontSize", mx: "auto" }}
              />
            </>
          ) : (
            <>
              <Typography
                variant="h6"
                fontWeight={"bold"}
                textAlign={"center"}
                sx={{ pb: 2, mt: 1 }}
              >
                Tổng số người mua
              </Typography>
              <Typography
                variant="h5"
                fontWeight={"bold"}
                textAlign={"center"}
                color="red"
                sx={{ pb: 2, mt: 1 }}
              >
                {Format.formatNumber(data?.count_user)}
              </Typography>
            </>
          )}
        </PaperCustom>
      </Grid2>

      <Grid2 size={4}>
        <PaperCustom sx={{ px: 3 }}>
          {loading ? (
            <>
              <Skeleton
                variant="text"
                width={"60%"}
                sx={{ pb: 2, mt: 1, fontSize: "h6.fontSize", mx: "auto" }}
              />
              <Skeleton
                width={"40%"}
                sx={{ pb: 2, mt: 1, fontSize: "h5.fontSize", mx: "auto" }}
              />
            </>
          ) : (
            <>
              <Typography
                variant="h6"
                fontWeight={"bold"}
                textAlign={"center"}
                sx={{ pb: 2, mt: 1 }}
              >
                Tổng số sản phẩm
              </Typography>
              <Typography
                variant="h5"
                fontWeight={"bold"}
                textAlign={"center"}
                color="red"
                sx={{ pb: 2, mt: 1 }}
              >
                {Format.formatNumber(data?.count_product)}
              </Typography>
            </>
          )}
        </PaperCustom>
      </Grid2>

      <Grid2 size={12}>
        <PaperCustom sx={{ px: 3 }}>
          <Typography variant="h6" fontWeight={"bold"} sx={{ pb: 2, mt: 1 }}>
            Số đơn hàng được tạo trong tháng {month}
          </Typography>

          <MonthlyOrderChart />
        </PaperCustom>
      </Grid2>
    </Grid2>
  );
};

export default Dashboard;
