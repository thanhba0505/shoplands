import { useState } from "react";
import { useDispatch } from "react-redux";
import { useSnackbar } from "notistack";
import { Box, TextField, Typography } from "@mui/material";
import ButtonLoading from "~/components/ButtonLoading";
import { useNavigate } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import { useTheme } from "@emotion/react";
import Path from "~/helpers/Path";
import Validator from "~/helpers/Validator";

const Register = () => {
  const navigate = useNavigate();
  const dispatch = useDispatch();
  const { enqueueSnackbar } = useSnackbar();
  const theme = useTheme();

  const [phone, setPhone] = useState("");
  const [password, setPassword] = useState("");
  const [confirmPassword, setConfirmPassword] = useState("");
  const [verificationCode, setVerificationCode] = useState("");
  const [isLoading, setIsLoading] = useState(false);

  const handleRegister = () => {
    // Kiểm tra số điện thoại
    if (!Validator.isPhone(phone)) {
      enqueueSnackbar("Số điện thoại không hợp lệ!", { variant: "error" });
      return;
    }

    // Kiểm tra độ mạnh mật khẩu
    const passwordValidationMessage = Validator.isPasswordStrength(password);
    if (passwordValidationMessage !== "Mật khẩu hợp lệ") {
      enqueueSnackbar(passwordValidationMessage, { variant: "error" });
      return;
    }

    // Kiểm tra mật khẩu và nhập lại mật khẩu
    if (password !== confirmPassword) {
      enqueueSnackbar("Mật khẩu không khớp!", { variant: "error" });
      return;
    }

    console.log("Đăng ký thành công", { phone, password });
  };

  const handleSendVerificationCode = () => {
    console.log("Gui ma xac thuc");
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
        <Box sx={{ display: "flex", justifyContent: "space-between", gap: 2 }}>
          <TextField
            autoComplete="off"
            sx={{ flex: 3 }}
            fullWidth
            label="Mã xác nhận"
            variant="outlined"
            margin="normal"
            value={verificationCode}
            onChange={(e) => setVerificationCode(e.target.value)}
            disabled={isLoading}
          />
          <ButtonLoading
            sx={{
              mt: 2,
              height: 56,
              flex: 1,
              backgroundColor: theme.custom?.primary?.light,
              color: theme.palette.primary.main,
            }}
            variant="outlined"
            color="primary"
            onClick={handleSendVerificationCode}
            loading={isLoading}
          >
            Lấy mã
          </ButtonLoading>
        </Box>

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
