import { useEffect, useState } from "react";
import { useDispatch } from "react-redux";
import { loginSuccess } from "~/redux/authSlice";
import axiosDefault from "~/utils/axiosDefault";
import { useSnackbar } from "notistack";
import Api from "~/helpers/Api";
import { Box, Grid2, TextField, Typography } from "@mui/material";
import { startLoading, stopLoading } from "~/redux/loadingSlice";
import ButtonLoading from "~/components/ButtonLoading";
import { useNavigate } from "react-router-dom";
import Path from "~/helpers/Path";
import PaperCustom from "~/components/PaperCustom";
import { useTheme } from "@emotion/react";
import Log from "~/helpers/Log";
import axiosDefaultNoEnq from "~/utils/axiosDefaultNoEnq";

const Login = () => {
  const navigate = useNavigate();
  const dispatch = useDispatch();
  const { enqueueSnackbar } = useSnackbar();

  const [phone, setPhone] = useState("");
  const [password, setPassword] = useState("");
  const [code, setCode] = useState("");

  const [isLoading, setIsLoading] = useState(false);
  const [isLoadingGetCode, setIsLoadingGetCode] = useState(false);
  const [open, setOpen] = useState(false);
  const [disabled, setDisabled] = useState(false);

  const [timeLeft, setTimeLeft] = useState(0);
  const theme = useTheme();

  const handleOpen = () => {
    setOpen(true);
  };
  const handleClose = () => {
    setOpen(false);
  };

  useEffect(() => {
    if (!phone || !password || (open && code.length !== 6)) {
      setDisabled(true);
    } else {
      setDisabled(false);
    }
  }, [phone, password, code, open]);

  useEffect(() => {
    let timer;
    if (timeLeft > 0) {
      timer = setInterval(() => {
        setTimeLeft((prevTime) => prevTime - 1);
      }, 1000);
    }

    return () => clearInterval(timer); // Clear interval khi component unmount hoặc timeLeft = 0
  }, [timeLeft]);

  const handleLogin = async () => {
    dispatch(startLoading());
    setIsLoading(true);
    try {
      const response = await axiosDefaultNoEnq.post(Api.login(), {
        phone,
        password,
        code: code ? code : null,
      });

      const { access_token, refresh_token, account } = response.data;
      dispatch(loginSuccess({ access_token, refresh_token, account }));
      handleClose();
      enqueueSnackbar("Đăng nhập thành công!", { variant: "success" });

      if (account.role === "user") {
        navigate(Path.home());
      } else if (account.role === "seller") {
        navigate(Path.sellerDashboard());
      } else if (account.role === "admin") {
        navigate(Path.adminDashboard());
      }
    } catch (error) {
      if (error.response?.status === 409) {
        if (!open) {
          handleGetCodeLogin();
        }
        handleOpen();
      }
      if (error.response?.status === 401 || error.response?.status === 400) {
        enqueueSnackbar(error.response.data.message, { variant: "error" });
      }
      Log.error(error.response?.data?.message);
    } finally {
      setIsLoading(false);
      dispatch(stopLoading());
    }
  };

  const handleGetCodeLogin = async () => {
    try {
      setIsLoadingGetCode(true);
      const response = await axiosDefault.post(Api.codeLogin(), {
        phone,
        password,
      });

      enqueueSnackbar(response.data.message, { variant: "info" });
      setTimeLeft(60); // Đặt thời gian đếm ngược lại 60 giây khi gửi mã thành công

      if (response.data.message_body) {
        enqueueSnackbar(response.data.message_body, {
          variant: "info",
          anchorOrigin: {
            vertical: "bottom",
            horizontal: "left",
          },
          autoHideDuration: 10000,
        });
      }
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setIsLoadingGetCode(false);
    }
  };

  const reset = () => {
    setPhone("");
    setPassword("");
    setCode("");
    setOpen(false);
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
          width: 450,
          border: "1px solid",
          borderColor: "primary.light",
        }}
      >
        <Typography variant="h5" sx={{ fontWeight: "bold", mb: 2 }}>
          Đăng Nhập
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
          label="Mật khẩu"
          variant="outlined"
          margin="normal"
          type="password"
          value={password}
          onChange={(e) => setPassword(e.target.value)}
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
                onClick={handleGetCodeLogin}
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
          onClick={handleLogin}
          loading={isLoading}
          disabled={disabled}
        >
          Đăng nhập
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
            Làm mới đăng nhập
          </Typography>
        )}

        <Typography
          variant="body2"
          sx={{
            mt: 2,
            color: "primary.main",
            cursor: "pointer",
            userSelect: "none",
          }}
          onClick={() => navigate(Path.register())}
        >
          Chưa có tài khoản? Đăng ký
        </Typography>

        <Typography
          variant="body2"
          sx={{
            mt: 2,
            color: "primary.main",
            cursor: "pointer",
            userSelect: "none",
          }}
          onClick={() => navigate(Path.forgotPassword())}
        >
          Quên mật khẩu?
        </Typography>
      </PaperCustom>
    </Box>
  );
};

export default Login;
