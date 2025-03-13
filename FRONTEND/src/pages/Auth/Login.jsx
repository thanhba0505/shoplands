import { useState } from "react";
import { useDispatch } from "react-redux";
import { loginSuccess } from "~/redux/authSlice";
import axiosDefault from "~/utils/axiosDefault";
import { useSnackbar } from "notistack";
import Api from "~/helpers/Api";
import { Box, TextField, Typography } from "@mui/material";
import { startLoading, stopLoading } from "~/redux/loadingSlice";
import ButtonLoading from "~/components/ButtonLoading";
import { useNavigate } from "react-router-dom";
import Path from "~/helpers/Path";
import PaperCustom from "~/components/PaperCustom";
import { useTheme } from "@emotion/react";

const Login = () => {
  const navigate = useNavigate();
  const [phone, setPhone] = useState("");
  const [password, setPassword] = useState("");
  const dispatch = useDispatch();
  const { enqueueSnackbar } = useSnackbar();
  const [isLoading, setIsLoading] = useState(false);
  const [code, setCode] = useState("");
  const [open, setOpen] = useState(false);

  const theme = useTheme();

  const handleOpen = () => {
    setOpen(true);
  };
  const handleClose = () => {
    setOpen(false);
  };

  const handleLogin = async () => {
    if (!phone || !password) {
      enqueueSnackbar("Vui lòng nhập đầy đủ thông tin", { variant: "error" });
      return;
    }
    dispatch(startLoading());
    setIsLoading(true);
    try {
      const response = await axiosDefault.post(Api.login(), {
        phone,
        password,
        code: code ? code : null,
      });

      const { access_token, refresh_token, account } = response.data;
      dispatch(loginSuccess({ access_token, refresh_token, account }));
      handleClose();
      enqueueSnackbar("Đăng nhập thành công!", { variant: "success" });
      navigate(Path.home());
    } catch (error) {
      if (error.response?.status === 409) {
        handleOpen();
      } else {
        console.error("Đăng nhập thất bại: " + error.response.data.message);
      }
    } finally {
      setIsLoading(false);
      dispatch(stopLoading());
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
          disabled={isLoading}
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
          disabled={isLoading}
        />
        {open && (
          <TextField
            autoComplete="off"
            fullWidth
            label="Mã xác nhận"
            variant="outlined"
            margin="normal"
            type="text"
            value={code}
            onChange={(e) => setCode(e.target.value)}
            disabled={isLoading}
          />
        )}
        <ButtonLoading
          fullWidth
          sx={{ mt: 2, height: 56 }}
          variant="contained"
          color="primary"
          onClick={handleLogin}
          loading={isLoading}
        >
          Đăng nhập
        </ButtonLoading>

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
          Chưa có tài khoản? Đăng ký!
        </Typography>

        <Typography
          variant="body2"
          sx={{
            mt: 2,
            color: "primary.main",
            cursor: "pointer",
            userSelect: "none",
          }}
        >
          Quên mật khẩu?
        </Typography>
      </PaperCustom>
    </Box>
  );
};

export default Login;
