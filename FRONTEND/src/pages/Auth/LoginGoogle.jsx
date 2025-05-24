import { useEffect, useState } from "react";
import { useDispatch } from "react-redux";
import { loginSuccess } from "~/redux/authSlice";
import axiosDefault from "~/utils/axiosDefault";
import { useSnackbar } from "notistack";
import Api from "~/helpers/Api";
import { Box, Grid2, TextField, Typography } from "@mui/material";
import { startLoading, stopLoading } from "~/redux/loadingSlice";
import ButtonLoading from "~/components/ButtonLoading";
import { useNavigate, useSearchParams } from "react-router-dom";
import Path from "~/helpers/Path";
import PaperCustom from "~/components/PaperCustom";
import { useTheme } from "@emotion/react";
import Log from "~/helpers/Log";
import GoogleIcon from "@mui/icons-material/Google";

const LoginGoogle = () => {
  const navigate = useNavigate();
  const [searchParams] = useSearchParams();
  const dispatch = useDispatch();
  const { enqueueSnackbar } = useSnackbar();

  const account_id = searchParams.get("account_id");

  const [phone, setPhone] = useState("");
  const [code, setCode] = useState("");

  useEffect(() => {
    if (!account_id) {
      navigate(Path.login());
    }
  }, [searchParams, navigate, account_id]);

  const [isLoading, setIsLoading] = useState(false);
  const [isLoadingGetCode, setIsLoadingGetCode] = useState(false);
  const [disabled, setDisabled] = useState(false);

  const [timeLeft, setTimeLeft] = useState(0);
  const theme = useTheme();

  useEffect(() => {
    if (!phone || code.length !== 6) {
      setDisabled(true);
    } else {
      setDisabled(false);
    }
  }, [phone, code]);

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
      const response = await axiosDefault.post(
        Api.login("google/verify"),
        {
          phone,
          account_id,
          code,
        }
      );
      const { access_token, refresh_token, account } = response.data;
      dispatch(loginSuccess({ access_token, refresh_token, account }));

      enqueueSnackbar("Đăng nhập thành công!", { variant: "success" });
      if (account.role === "user") {
        navigate(Path.home());
      } else if (account.role === "seller") {
        navigate(Path.sellerDashboard());
      } else if (account.role === "admin") {
        navigate(Path.adminDashboard());
      }
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setIsLoading(false);
      dispatch(stopLoading());
    }
  };

  const handleGetCodeLogin = async () => {
    try {
      setIsLoadingGetCode(true);
      const response = await axiosDefault.post(Api.login("google/code"), {
        phone,
        account_id,
      });

      enqueueSnackbar(response.data.message, { variant: "info" });
      setTimeLeft(60);
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setIsLoadingGetCode(false);
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
          width: 450,
          border: "1px solid",
          borderColor: "primary.light",
        }}
      >
        <Typography variant="h5" sx={{ fontWeight: "bold", mb: 2 }}>
          Xác thực số điện thoại
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
          disabled={isLoading || isLoadingGetCode}
        />

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
              Lấy mã {timeLeft > 0 ? " (" + timeLeft + "s)" : ""}
            </ButtonLoading>
          </Grid2>
        </Grid2>

        <ButtonLoading
          fullWidth
          sx={{ mt: 2, height: 56 }}
          variant="contained"
          color="primary"
          onClick={handleLogin}
          loading={isLoading}
          disabled={disabled}
          startIcon={<GoogleIcon />}
        >
          Xác nhận
        </ButtonLoading>

        <Typography
          variant="body2"
          sx={{
            mt: 2,
            color: "primary.main",
            cursor: "pointer",
            userSelect: "none",
          }}
          onClick={() => navigate(Path.login())}
        >
          Đăng nhập bằng số điện thoại
        </Typography>

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
      </PaperCustom>
    </Box>
  );
};

export default LoginGoogle;
