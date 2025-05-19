import { BarChart } from "@mui/x-charts/BarChart";

const ProductSalesBarChart = () => {
  // Dữ liệu mô phỏng
  const productLabels = [
    "Áo thun",
    "Quần jean",
    "Giày thể thao",
    "Balo",
    "Mũ lưỡi trai",
  ];
  const salesData = [150, 90, 120, 60, 80];

  return (
    <BarChart
      width={500}
      height={300}
      series={[
        {
          data: salesData,
          label: "Số lượng bán ra",
          color: "#e98074",
        },
      ]}
      xAxis={[
        {
          data: productLabels,
          scaleType: "band",
          label: "Sản phẩm",
        },
      ]}
      yAxis={[{ label: "Số lượng" }]}
    />
  );
};

export default ProductSalesBarChart;
