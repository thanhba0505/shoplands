import { LineChart } from "@mui/x-charts/LineChart";

const margin = { right: 50 };

// Lấy ngày hiện tại
const today = new Date();
const currentYear = today.getFullYear();
const currentMonth = today.getMonth(); // getMonth() trả từ 0–11

// Lấy số ngày trong tháng gần nhất
const lastMonth = new Date(currentYear, currentMonth, 0);
const daysInMonth = lastMonth.getDate();
const month = (lastMonth.getMonth() + 1).toString().padStart(2, "0");

// Tạo nhãn trục X: các ngày cụ thể dạng "dd/MM"
const xLabels = Array.from({ length: daysInMonth }, (_, i) => {
  const day = (i + 1).toString().padStart(2, "0");
  return `${day}/${month}`;
});

// Random dữ liệu đơn hàng từ 10–100
const orderData = Array.from({ length: daysInMonth }, () =>
  Math.floor(Math.random() * 91 + 10)
);

const MonthlyOrderChart = () => {
  return (
    <LineChart
      height={300}
      series={[{ data: orderData, label: "Số đơn hàng", color: "#e85a4f" }]}
      xAxis={[
        {
          scaleType: "point",
          data: xLabels,
          label: "Ngày trong trong tháng " + month,
        },
      ]}
      yAxis={[{ width: 70 }]}
      margin={margin}
    />
  );
};

export default MonthlyOrderChart;
