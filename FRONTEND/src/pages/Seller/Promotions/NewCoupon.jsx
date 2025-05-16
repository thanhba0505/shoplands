import { useState } from "react";
import {
  Typography,
  TextField,
  MenuItem,
  Stack,
  Grid2,
  Card,
  CardContent,
} from "@mui/material";
import { LocalizationProvider } from "@mui/x-date-pickers/LocalizationProvider";
import { DatePicker } from "@mui/x-date-pickers/DatePicker";
import { AdapterDateFns } from "@mui/x-date-pickers/AdapterDateFns";
import vi from "date-fns/locale/vi"; // nếu muốn hỗ trợ tiếng Việt
import Log from "~/helpers/Log";
import axiosWithAuth from "~/utils/axiosWithAuth";
import Api from "~/helpers/Api";
import { useSnackbar } from "notistack";
import ButtonLoading from "~/components/ButtonLoading";
import Format from "~/helpers/Format";

const NewCoupon = () => {
  const initForm = {
    code: "",
    description: "",
    discount_type: "percentage",
    discount_value: "",
    maximum_discount: "",
    minimum_order_value: "",
    usage_limit: "",
    start_date: null,
    end_date: null,
  };

  const [form, setForm] = useState(initForm);

  const { enqueueSnackbar } = useSnackbar();

  const [loading, setLoading] = useState(false);

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = async () => {
    setLoading(true);
    try {
      const payload = {
        ...form,
        start_date: form.start_date
          ? form.start_date.toISOString().slice(0, 10)
          : "",
        end_date: form.end_date ? form.end_date.toISOString().slice(0, 10) : "",
      };

      const response = await axiosWithAuth.post(Api.sellerCoupons(), {
        ...payload,
      });

      enqueueSnackbar(response.data.message, { variant: "success" });
      setForm(initForm);
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  };

  return (
    <LocalizationProvider dateAdapter={AdapterDateFns} adapterLocale={vi}>
      <Grid2 container spacing={2} sx={{ mt: 4, mb: 2 }}>
        <Grid2 size={7}>
          <Stack spacing={2}>
            <TextField
              autoComplete="off"
              label="Mã giảm giá"
              required
              name="code"
              value={form.code}
              onChange={handleChange}
              fullWidth
            />
            <TextField
              autoComplete="off"
              label="Mô tả"
              name="description"
              value={form.description}
              onChange={handleChange}
              fullWidth
              multiline
              rows={3}
            />
            <TextField
              autoComplete="off"
              select
              label="Loại giảm giá"
              required
              name="discount_type"
              value={form.discount_type}
              onChange={handleChange}
              fullWidth
            >
              <MenuItem value="percentage">Phần trăm</MenuItem>
              <MenuItem value="fixed">Cố định</MenuItem>
            </TextField>
            <TextField
              required
              autoComplete="off"
              label="Giá trị giảm"
              name="discount_value"
              type="number"
              value={form.discount_value}
              onChange={handleChange}
              fullWidth
            />
            <TextField
              autoComplete="off"
              label="Giảm tối đa"
              name="maximum_discount"
              type="number"
              value={form.maximum_discount}
              onChange={handleChange}
              fullWidth
            />
            <TextField
              autoComplete="off"
              label="Giá trị đơn hàng tối thiểu"
              name="minimum_order_value"
              type="number"
              value={form.minimum_order_value}
              onChange={handleChange}
              fullWidth
            />
            <TextField
              autoComplete="off"
              label="Số lượt sử dụng"
              name="usage_limit"
              type="number"
              value={form.usage_limit}
              onChange={handleChange}
              fullWidth
            />
            <DatePicker
              label="Ngày bắt đầu *"
              value={form.start_date}
              onChange={(newValue) =>
                setForm({ ...form, start_date: newValue })
              }
              slotProps={{ textField: { fullWidth: true } }}
            />
            <DatePicker
              label="Ngày kết thúc *"
              value={form.end_date}
              onChange={(newValue) => setForm({ ...form, end_date: newValue })}
              slotProps={{ textField: { fullWidth: true } }}
            />

            <ButtonLoading
              loading={loading}
              variant="contained"
              onClick={handleSubmit}
              disabled={
                !form.code ||
                !form.discount_value ||
                !form.start_date ||
                !form.end_date ||
                !form.discount_type
              }
            >
              Thêm mã
            </ButtonLoading>
          </Stack>
        </Grid2>

        <Grid2 size={5}>
          <Card
            sx={{
              backgroundColor: "transparent",
              border: 1,
              borderColor: "primary.light",
              boxShadow: "none",
            }}
          >
            <CardContent>
              <Typography variant="h6" sx={{ fontWeight: "bold" }}>
                {form.code ? form.code : "Mã giảm giá"}
              </Typography>
              <Typography variant="body2" color="text.secondary">
                {form.description ? form.description : "Mô tả"}
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
                {form.discount_type === "percentage"
                  ? Format.formatPercentage(form.discount_value / 100)
                  : Format.formatCurrency(form.discount_value ? form.discount_value : 0)}
              </Typography>
              {form.maximum_discount && (
                <Typography variant="body2" color="text.secondary">
                  Giảm tối đa: {Format.formatCurrency(form.maximum_discount)}
                </Typography>
              )}
              <Typography variant="body2" color="text.secondary">
                Cho đơn hàng tối thiểu:{" "}
                {form.minimum_order_value
                  ? Format.formatCurrency(form.minimum_order_value)
                  : "0đ"}
              </Typography>{" "}
              <Typography variant="body2" color="text.secondary" sx={{ marginTop: 1 }}>
                Đã sử dụng: {"0"}/{form.usage_limit ? form.usage_limit : "0"}
              </Typography>
              <Typography variant="body2" color="text.secondary">
                Hạn sử dụng:{" "}
                {form.start_date
                  ? form.start_date.toISOString().slice(0, 10)
                  : "yyyy-mm-dd"}{" "}
                -{" "}
                {form.end_date
                  ? form.end_date.toISOString().slice(0, 10)
                  : "yyyy-mm-dd"}
              </Typography>
            </CardContent>
          </Card>
        </Grid2>
      </Grid2>
    </LocalizationProvider>
  );
};

export default NewCoupon;
