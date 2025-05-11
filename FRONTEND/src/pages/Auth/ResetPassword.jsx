import { useEffect, useState } from "react";
import { useDispatch } from "react-redux";
import { useSnackbar } from "notistack";
import { Box, Grid2, TextField, Typography } from "@mui/material";
import ButtonLoading from "~/components/ButtonLoading";
import { useNavigate } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import { useTheme } from "@emotion/react";
import Path from "~/helpers/Path";
import { startLoading, stopLoading } from "~/redux/loadingSlice";
import axiosDefault from "~/utils/axiosDefault";
import Api from "~/helpers/Api";
import { loginSuccess } from "~/redux/authSlice";
import Log from "~/helpers/Log";

const ResetPassword = () => {
  const navigate = useNavigate();
  const dispatch = useDispatch();
  const { enqueueSnackbar } = useSnackbar();
  const theme = useTheme();

  const [phone, setPhone] = useState("");
  const [password, setPassword] = useState("");
  const [confirmPassword, setConfirmPassword] = useState("");
  const [open, setOpen] = useState(false);
  const [code, setCode] = useState("");
  const [isLoading, setIsLoading] = useState(false);
  const [isLoadingGetCode, setIsLoadingGetCode] = useState(false);

  const [disabled, setDisabled] = useState(false);
  const [timeLeft, setTimeLeft] = useState(0);

  const reset = () => {
    setCode("");
    setConfirmPassword("");
    setPassword("");
    setPhone("");
    setOpen(false);
  };

  useEffect(() => {
    let timer;
    if (timeLeft > 0) {
      timer = setInterval(() => {
        setTimeLeft((prevTime) => prevTime - 1);
      }, 1000);
    }

    return () => clearInterval(timer);
  }, [timeLeft]);

  useEffect(() => {
    if (
      !phone ||
      !password ||
      !confirmPassword ||
      password !== confirmPassword ||
      (open && code.length !== 6)
    ) {
      setDisabled(true);
    } else {
      setDisabled(false);
    }
  }, [phone, password, code, open, confirmPassword]);

  const handleRegister = async () => {
    if (!open) {
      handleGetCodeForgot();
      return;
    }

    dispatch(startLoading());
    setIsLoading(true);
    try {
      const response = await axiosDefault.post(Api.forgotPassword(), {
        phone,
        password,
        code,
      });

      const { access_token, refresh_token, account } = response.data;
      dispatch(loginSuccess({ access_token, refresh_token, account }));
      setOpen(false);
      enqueueSnackbar("Đặt lại mật khẩu thành công!", { variant: "success" });
      navigate(Path.home());
    } catch (error) {
      if (error.response?.status === 409) {
        setOpen(true);
      } else {
        console.error("Đăng nhập thất bại: " + error.response.data.message);
      }
    } finally {
      setIsLoading(false);
      dispatch(stopLoading());
    }
  };

  const handleGetCodeForgot = async () => {
    try {
      if (!open) setIsLoading(true);
      setIsLoadingGetCode(true);
      const response = await axiosDefault.post(Api.codeForgotPassword(), {
        phone,
        password,
      });
      setOpen(true);
      enqueueSnackbar(response.data.message, { variant: "info" });
      setTimeLeft(60);
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setIsLoadingGetCode(false);
      if (!open) setIsLoading(false);
    }
  };

  return (
    <Box
      sx={{
        minHeight: `calc(100vh - ${theme.custom.headerHeight} - 2 * ${theme.custom.containerGap})`,
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
        borderRadius: "12px",
      }}
    >
      <PaperCustom
        elevation={2}
        sx={{
          textAlign: "center",
          paddingX: 6,
          paddingY: 8,
          width: 500,
          border: "1px solid",
          borderColor: "primary.light",
        }}
      >
        <Typography variant="h5" sx={{ fontWeight: "bold", mb: 2 }}>
          Đặt lại mật khẩu
        </Typography>

        <TextField
          autoComplete="off"
          fullWidth
          label="Số điện thoại"
          variant="outlined"
          margin="normal"
          type="text"
          value={phone}
          onChange={(e) => setPhone(e.target.value)}
          disabled={isLoading || isLoadingGetCode || open}
        />

        <TextField
          autoComplete="off"
          fullWidth
          label="Mật khẩu mới"
          variant="outlined"
          margin="normal"
          type="password"
          value={password}
          onChange={(e) => setPassword(e.target.value)}
          disabled={isLoading || isLoadingGetCode || open}
        />
        <TextField
          autoComplete="off"
          fullWidth
          label="Nhập lại mật khẩu"
          variant="outlined"
          margin="normal"
          type="password"
          value={confirmPassword}
          onChange={(e) => setConfirmPassword(e.target.value)}
          disabled={isLoading || isLoadingGetCode || open}
        />
        {open && (
          <Grid2 container spacing={2}>
            <Grid2 size={6}>
              <TextField
                autoComplete="off"
                fullWidth
                label="Mã xác nhận"
                variant="outlined"
                margin="normal"
                type="text"
                value={code}
                onChange={(e) => setCode(e.target.value)}
                disabled={isLoading || isLoadingGetCode}
              />
            </Grid2>
            <Grid2 size={6}>
              <ButtonLoading
                fullWidth
                sx={{ mt: 2, height: 56 }}
                variant="outlined"
                color="success"
                onClick={handleGetCodeForgot}
                loading={isLoadingGetCode}
                disabled={timeLeft > 0} // Disable button nếu còn thời gian đếm ngược
              >
                Gửi lại mã {timeLeft > 0 ? " (" + timeLeft + "s)" : ""}
              </ButtonLoading>
            </Grid2>
          </Grid2>
        )}
        <ButtonLoading
          fullWidth
          sx={{ mt: 2, height: 56 }}
          variant="contained"
          color="primary"
          onClick={handleRegister}
          loading={isLoading}
          disabled={disabled}
        >
          Xác nhận
        </ButtonLoading>
        {open && (
          <Typography
            variant="body2"
            sx={{
              mt: 2,
              color: "primary.main",
              cursor: "pointer",
              userSelect: "none",
            }}
            onClick={reset}
          >
            Làm mới biểu mẩu
          </Typography>
        )}
      </PaperCustom>
    </Box>
  );
};

export default ResetPassword;
