import { useState } from "react";
import { useDispatch } from "react-redux";
import { loginSuccess } from "~/redux/authSlice";
import axiosDefault from "~/utils/axiosDefault";
import { useSnackbar } from "notistack";
import Api from "~/helpers/Api";
import { Box, TextField, Typography, Paper } from "@mui/material";
import { startLoading, stopLoading } from "~/redux/loadingSlice";
import ButtonLoading from "~/components/ButtonLoading";
import { useNavigate } from "react-router-dom";
import Path from "~/helpers/Path";

const Login = () => {
    const navigate = useNavigate();
    const [phone, setPhone] = useState("");
    const [password, setPassword] = useState("");
    const dispatch = useDispatch();
    const { enqueueSnackbar } = useSnackbar();
    const [isLoading, setIsLoading] = useState(false);

    const handleLogin = async () => {
        dispatch(startLoading());
        setIsLoading(true);
        try {
            const response = await axiosDefault.post(Api.login(), {
                phone,
                password,
            });

            const { access_token, refresh_token, account } = response.data;
            dispatch(loginSuccess({ access_token, refresh_token, account }));
            enqueueSnackbar("Đăng nhập thành công!", { variant: "success" });
            navigate(Path.home());
        } catch (error) {
            console.error("Đăng nhập thất bại: " + error.response.data.message);
        } finally {
            setIsLoading(false);
            dispatch(stopLoading());
        }
    };

    return (
        <Paper
            elevation={2}
            sx={(theme) => ({
                height: `calc(100vh - ${theme.custom.headerHeight} - 2 * ${theme.custom.paddingYContainer})`,
                display: "flex",
                justifyContent: "center",
                alignItems: "center",
                borderRadius: "12px",
            })}
        >
            <Box
                sx={{
                    paddingX: 6,
                    paddingY: 8,
                    width: 450,
                    border: "2px dashed ",
                    borderColor: "primary.light",
                    textAlign: "center",
                    borderRadius: "12px",
                    backgroundColor: "#fff",
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
                >
                    Quên mật khẩu?
                </Typography>
            </Box>
        </Paper>
    );
};

export default Login;
