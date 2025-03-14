import { useState } from "react";
import { useDispatch } from "react-redux";
import { useSnackbar } from "notistack";
import { Box, TextField, Typography } from "@mui/material";
import ButtonLoading from "~/components/ButtonLoading";
import { useNavigate } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import { useTheme } from "@emotion/react";
import Path from "~/helpers/Path";
import { startLoading, stopLoading } from "~/redux/loadingSlice";
import axiosDefault from "~/utils/axiosDefault";
import Api from "~/helpers/Api";
import { loginSuccess } from "~/redux/authSlice";

const Register = () => {
  const navigate = useNavigate();
  const dispatch = useDispatch();
  const { enqueueSnackbar } = useSnackbar();
  const theme = useTheme();

  const [phone, setPhone] = useState("");
  const [name, setName] = useState("");
  const [password, setPassword] = useState("");
  const [confirmPassword, setConfirmPassword] = useState("");
  const [open, setOpen] = useState(false);
  const [code, setCode] = useState("");
  const [isLoading, setIsLoading] = useState(false);

  const handleRegister = async () => {
    if (!checkInfo()) return;

    dispatch(startLoading());
    setIsLoading(true);
    try {
      const response = await axiosDefault.post(Api.register(), {
        name,
        phone,
        password,
        code,
      });

      const { access_token, refresh_token, account } = response.data;
      dispatch(loginSuccess({ access_token, refresh_token, account }));
      setOpen(false);
      enqueueSnackbar("Đăng nhập thành công!", { variant: "success" });
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

  const checkInfo = () => {
    // Kiểm tra số điện thoại
    if (!phone) {
      enqueueSnackbar("Số điện thoại được rỗng!", { variant: "error" });
      return false;
    }

    // Kiểm tra độ mạnh mật khẩu
    if (!password) {
      enqueueSnackbar("Mật khẩu không được rỗng", { variant: "error" });
      return false;
    }

    // Kiểm tra mật khẩu và nhập lại mật khẩu
    if (password !== confirmPassword) {
      enqueueSnackbar("Nhập lại mật khẩu không đúng!", { variant: "error" });
      return false;
    }

    return true;
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
          Đăng Ký
        </Typography>
        <TextField
          autoComplete="off"
          fullWidth
          label="Họ và tên"
          variant="outlined"
          margin="normal"
          type="text"
          value={name}
          onChange={(e) => setName(e.target.value)}
          disabled={isLoading}
        />

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
        <TextField
          autoComplete="off"
          fullWidth
          label="Nhập lại mật khẩu"
          variant="outlined"
          margin="normal"
          type="password"
          value={confirmPassword}
          onChange={(e) => setConfirmPassword(e.target.value)}
          disabled={isLoading}
        />
        {open && (
          <TextField
            autoComplete="off"
            fullWidth
            label="Nhập mã xác nhận"
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
          onClick={handleRegister}
          loading={isLoading}
        >
          Đăng ký
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
          Đã có tài khoản? Đăng nhập!
        </Typography>
      </PaperCustom>
    </Box>
  );
};

export default Register;
