import {
  Box,
  Card,
  CardContent,
  Grid2,
  Skeleton,
  Typography,
} from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import Api from "~/helpers/Api";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import axiosWithAuth from "~/utils/axiosWithAuth";

const Coupons = ({ setLoading, loading, expired = false }) => {
  const [coupons, setCoupons] = useState([]);
  const navigate = useNavigate();

  const fetchApi = useCallback(async () => {
    setLoading(true);
    try {
      let url = Api.sellerCoupons();

      if (expired) {
        url += "?expired=true";
      }

      const response = await axiosWithAuth.get(url, {
        navigate,
      });
      setCoupons(response.data);
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  }, [setLoading, expired, navigate]);

  useEffect(() => {
    fetchApi();
  }, [fetchApi]);

  return (
    <>
      {loading ? (
        <>
          <Grid2 container spacing={8} my={6}>
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
          <Box sx={{ my: 2 }}>
            <Box display="flex" flexWrap="wrap" gap={2} py={1}>
              {coupons.length === 0 ? (
                <>Không có mã giảm giá</>
              ) : (
                coupons.map((coupon) => (
                  <Box
                    key={coupon.coupon_id}
                    width="calc(33.333% - 16px)"
                    marginBottom={2}
                    sx={{
                      border: `1px solid #ccc`,
                      m: 0,
                      borderRadius: "8px",
                      padding: 1,
                      transition: "background-color 0.3s",
                      backgroundColor: "transparent",
                      "&:hover": {
                        backgroundColor: "#f0f8ff",
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
                        <Typography
                          variant="body2"
                          color="text.secondary"
                          sx={{ marginTop: 1 }}
                        >
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
    </>
  );
};

export default Coupons;
