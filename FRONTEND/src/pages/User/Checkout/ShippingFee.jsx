import {
  Box,
  Skeleton,
  Typography,
} from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import { useSelector } from "react-redux";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import axiosWithAuth from "~/utils/axiosWithAuth";

const ShippingFee = ({ addressId, shipping, setShipping }) => {
  const [loading, setLoading] = useState(true);
  const sellerId = useSelector((state) => state.order.seller_id);

  const fetchApi = useCallback(async () => {
    setLoading(true);
    try {
      if (!addressId) {
        setShipping({});
        return;
      }
      const response = await axiosWithAuth.get(
        Api.shippingFee(addressId + "/" + sellerId)
      );
      setShipping(response.data);
    } catch (error) {
      setShipping({});
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  }, [addressId, sellerId, setShipping]);

  useEffect(() => {
    fetchApi();
  }, [fetchApi]);

  return (
    <PaperCustom sx={{ px: 3 }}>
      {loading ? (
        <>
          <Skeleton
            variant="rounded"
            height={32}
            width={350}
            sx={{ mb: 2, px: 2 }}
          />
          <Skeleton
            variant="rounded"
            height={48}
            width={"100%"}
            sx={{ mb: 1, mt: 1, px: 2 }}
          />
        </>
      ) : (
        <>
          <Typography variant="h6" sx={{ marginBottom: 2 }}>
            Phương thức giao hàng (Giao hàng nhanh)
          </Typography>

          <Box sx={{ pb: 1 }}>
            {shipping.fee ? (
              <>
                <Typography>
                  Phí vận chuyển: {Format.formatCurrency(shipping.fee)}
                </Typography>
                <Typography>
                  Thời gian giao hàng dự kiến:{" "}
                  {Format.calculateEstimatedTime(
                    shipping.leadtime.from_estimate_date,
                    shipping.leadtime.to_estimate_date
                  )}
                </Typography>
              </>
            ) : (
              <>Vui lòng chọn địa chỉ khác</>
            )}
          </Box>
        </>
      )}
    </PaperCustom>
  );
};

export default ShippingFee;
