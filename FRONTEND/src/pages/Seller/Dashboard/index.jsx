import { Grid2, Typography } from "@mui/material";
import PaperCustom from "~/components/PaperCustom";
import MonthlyOrderChart from "./MonthlyOrderChart";
import OrderStatusPie from "./OrderStatusPie";
import ProductSalesBarChart from "./ProductSalesBarChart";

const Dashboard = () => {
  const today = new Date();
  const currentYear = today.getFullYear();
  const currentMonth = today.getMonth();
  const lastMonth = new Date(currentYear, currentMonth, 0);
  const month = (lastMonth.getMonth() + 1).toString().padStart(2, "0");

  return (
    <Grid2 container spacing={3}>
      <Grid2 size={12}>
        <PaperCustom sx={{ px: 3 }}>
          <Typography variant="h6" fontWeight={"bold"} sx={{ pb: 2, mt: 1 }}>
            Số đơn hàng trong tháng {month}
          </Typography>
          <MonthlyOrderChart />
        </PaperCustom>
      </Grid2>

      <Grid2 container size={12} spacing={3}>
        <Grid2 size={6} height={"100%"}>
          <PaperCustom sx={{ px: 3, height: "100%" }}>
            <Typography variant="h6" fontWeight={"bold"} sx={{ pb: 2, mt: 1 }}>
              Tỉ lệ đơn hàng
            </Typography>
            <OrderStatusPie />
          </PaperCustom>
        </Grid2>

        <Grid2 size={6} height={"100%"}>
          <PaperCustom sx={{ px: 3, height: "100%" }}>
            <Typography variant="h6" fontWeight={"bold"} sx={{ pb: 2, mt: 1 }}>
              Lượt bán sản phẩm
            </Typography>
            <ProductSalesBarChart />
          </PaperCustom>
        </Grid2>
      </Grid2>
    </Grid2>
  );
};

export default Dashboard;
