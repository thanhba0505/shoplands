import { PieChart } from "@mui/x-charts/PieChart";

export default function OrderStatusPie() {
  return (
    <PieChart
      series={[
        {
          data: [
            { id: 0, value: 120, label: "Đã hoàn thành" },
            { id: 1, value: 27, label: "Đã hủy" },
            { id: 2, value: 8, label: "Đã trả hàng" },
          ],
        },
      ]}
      width={300}
      height={300}
    />
  );
}
