import {
  Box,
  Card,
  CardContent,
  Grid2,
  Skeleton,
  Typography,
} from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import { useSelector } from "react-redux";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import axiosDefault from "~/utils/axiosDefault";

const Coupons = ({ subTotal, setCoupon, coupon }) => {
  const seller_id = useSelector((state) => state.order.seller_id);
  const [coupons, setCoupons] = useState([]);
  const [loading, setLoading] = useState(true);

  const fetchApi = useCallback(async () => {
    setLoading(true);
    try {
      if (seller_id) {
        const response = await axiosDefault.get(Api.coupons(seller_id));
        setCoupons(response.data);
      }
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  }, [seller_id]);

  useEffect(() => {
    fetchApi();
  }, [fetchApi, seller_id]);

  let selectedCoupon = coupon;

  const handleSelectCoupon = (selectedCoupon, minimumOrderValue) => {
    // Kiểm tra xem subTotal có đáp ứng được đơn hàng tối thiểu không
    if (subTotal >= minimumOrderValue) {
      // Toggle selection: Nếu đã chọn thì bỏ chọn, nếu chưa chọn thì chọn
      setCoupon(selectedCoupon === coupon ? null : selectedCoupon);
    }
  };

  return (
    <PaperCustom sx={{ px: 3 }}>
      {loading ? (
        <>
          <Skeleton
            variant="rectangular"
            height={30}
            width={350}
            sx={{ mb: 1.5, my: 1, px: 2 }}
          />
          <Grid2 container spacing={8} mt={3}>
            <Grid2 container size={4} spacing={2} alignItems="flex-start">
              <Skeleton variant="rectangular" height={20} width={"100%"} />
              <Skeleton variant="rectangular" height={16} width={"40%"} />
              <Skeleton variant="rectangular" height={16} width={"80%"} />
              <Skeleton variant="rectangular" height={16} width={"50%"} />
            </Grid2>
            <Grid2 container size={4} spacing={2} alignItems="flex-start">
              <Skeleton variant="rectangular" height={20} width={"100%"} />
              <Skeleton variant="rectangular" height={16} width={"40%"} />
              <Skeleton variant="rectangular" height={16} width={"80%"} />
              <Skeleton variant="rectangular" height={16} width={"50%"} />
            </Grid2>
            <Grid2 container size={4} spacing={2} alignItems="flex-start">
              <Skeleton variant="rectangular" height={20} width={"100%"} />
              <Skeleton variant="rectangular" height={16} width={"40%"} />
              <Skeleton variant="rectangular" height={16} width={"80%"} />
              <Skeleton variant="rectangular" height={16} width={"50%"} />
            </Grid2>
          </Grid2>
        </>
      ) : (
        <>
          <Typography variant="h6" sx={{ marginBottom: 2 }}>
            Mã Giảm Giá
          </Typography>

          <Box sx={{ maxHeight: "430px", overflowY: "auto", mb: 2 }}>
            <Box display="flex" flexWrap="wrap" gap={2} py={1}>
              {coupons.length === 0 ? (
                <>Không có mã giảm giá</>
              ) : (
                coupons.map((coupon) => (
                  <Box
                    key={coupon.coupon_id}
                    width="calc(33.333% - 16px)"
                    marginBottom={2}
                    onClick={
                      () =>
                        handleSelectCoupon(coupon, coupon.minimum_order_value) // Pass full coupon object
                    }
                    sx={{
                      cursor: "pointer",
                      border: `1px solid ${
                        coupon === selectedCoupon ? "blue" : "#ccc"
                      }`,
                      m: 0,
                      borderRadius: "8px",
                      padding: 1,
                      transition: "background-color 0.3s",
                      backgroundColor:
                        subTotal < coupon.minimum_order_value
                          ? "#d3d3d3" // Nền xám nếu không đủ điều kiện
                          : coupon === selectedCoupon
                          ? "#f0f8ff" // Nền màu xanh khi chọn
                          : "transparent",
                      opacity: subTotal < coupon.minimum_order_value ? 0.5 : 1, // Làm mờ nếu không đủ điều kiện
                      pointerEvents:
                        subTotal < coupon.minimum_order_value ? "none" : "",
                      "&:hover": {
                        backgroundColor:
                          subTotal < coupon.minimum_order_value
                            ? "#d3d3d3" // Giữ nền xám khi hover nếu không đủ điều kiện
                            : "#f0f8ff", // Giữ nền xanh khi hover nếu chọn
                      },
                    }}
                  >
                    <Card
                      sx={{
                        backgroundColor: "transparent",
                        border: "none",
                        boxShadow: "none",
                      }}
                    >
                      <CardContent>
                        <Typography variant="h6" sx={{ fontWeight: "bold" }}>
                          {coupon.code}
                        </Typography>
                        <Typography variant="body2" color="text.secondary">
                          {coupon.description}
                        </Typography>
                        <Typography
                          variant="h6"
                          sx={{
                            marginTop: 1,
                            fontWeight: "bold",
                            color: "red",
                          }}
                        >
                          Giảm:{" "}
                          {coupon.discount_type === "percentage"
                            ? Format.formatPercentage(
                                coupon.discount_value / 100
                              )
                            : Format.formatCurrency(coupon.discount_value)}
                        </Typography>
                        {coupon.maximum_discount && (
                          <Typography variant="body2" color="text.secondary">
                            Giảm tối đa:{" "}
                            {Format.formatCurrency(coupon.maximum_discount)}
                          </Typography>
                        )}
                        <Typography variant="body2" color="text.secondary">
                          Cho đơn hàng tối thiểu:{" "}
                          {coupon.minimum_order_value
                            ? Format.formatCurrency(coupon.minimum_order_value)
                            : "Không yêu cầu"}
                        </Typography>
                        <Typography variant="body2" sx={{ marginTop: 1 }}>
                          Đã sử dụng: {coupon.usage_count}/{coupon.usage_limit}
                        </Typography>
                        <Typography variant="body2" color="text.secondary">
                          Hạn sử dụng: {coupon.start_date} - {coupon.end_date}
                        </Typography>
                      </CardContent>
                    </Card>
                  </Box>
                ))
              )}
            </Box>
          </Box>
        </>
      )}
    </PaperCustom>
  );
};

export default Coupons;
