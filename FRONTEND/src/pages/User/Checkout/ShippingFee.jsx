import {
  Box,
  FormControl,
  InputLabel,
  MenuItem,
  Select,
  Skeleton,
  Typography,
} from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import axiosDefault from "~/utils/axiosDefault";

const ShippingFee = ({ setShippingFee, shippingFee }) => {
  const [shippingFees, setShippingFees] = useState([]);
  const [loading, setLoading] = useState(true);

  const fetchApi = useCallback(async () => {
    setLoading(true);
    try {
      const response = await axiosDefault.get(Api.shippingFees());
      setShippingFees(response.data);

      // Cài phương thức giao hàng mặc định là phương thức đầu tiên trong mảng (nếu có)
      if (response.data && response.data.length > 0) {
        setShippingFee(response.data[0]); // Đặt phương thức giao hàng đầu tiên là mặc định
      }
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  }, [setShippingFee]);

  useEffect(() => {
    fetchApi();
  }, [fetchApi]);

  const handleChange = (event) => {
    const selectedShippingFee = shippingFees.find(
      (item) => item.shipping_fee_id === event.target.value
    );
    setShippingFee(selectedShippingFee); // Lưu phương thức giao hàng được chọn
  };

  return (
    <PaperCustom sx={{ px: 3 }}>
      {loading ? (
        <>
          <Skeleton
            variant="rounded"
            height={32}
            width={350}
            sx={{ mb: 2, my: 1, px: 2 }}
          />
          <Skeleton
            variant="rounded"
            height={56}
            width={"100%"}
            sx={{ mb: 2, mt: 2, px: 2 }}
          />
        </>
      ) : (
        <>
          <Typography variant="h6" sx={{ marginBottom: 2 }}>
            Phương thức giao hàng
          </Typography>

          <Box sx={{ pt: 1, pb: 2 }}>
            {shippingFee && (
              <FormControl fullWidth>
                <InputLabel id="shipping-fee-select-label">
                  Chọn phương thức giao hàng
                </InputLabel>
                <Select
                  labelId="shipping-fee-select-label"
                  value={shippingFee.shipping_fee_id} // Đảm bảo rằng giá trị luôn hợp lệ
                  onChange={handleChange}
                  label="Chọn phương thức giao hàng"
                >
                  {shippingFees.map((item) => (
                    <MenuItem
                      key={item.shipping_fee_id}
                      value={item.shipping_fee_id}
                    >
                      {item.method} - {Format.formatCurrency(item.price)}{" "}
                      {/* Hiển thị phương thức và giá */}
                    </MenuItem>
                  ))}
                </Select>
              </FormControl>
            )}
          </Box>
        </>
      )}
    </PaperCustom>
  );
};

export default ShippingFee;
