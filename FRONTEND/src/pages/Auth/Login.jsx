import { useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import { loginSuccess } from "~/redux/authSlice";
import { startLoading, stopLoading } from "~/redux/loadingSlice";
import axiosDefault from "~/utils/axiosDefault";
import { useSnackbar } from "notistack";
import { Button } from "@mui/material";

const Login = () => {
    const [phone, setPhone] = useState("");
    const [password, setPassword] = useState("");
    const dispatch = useDispatch();
    const { enqueueSnackbar } = useSnackbar();
    const isLoading = useSelector((state) => state.loading.isLoading);

    const handleLogin = async () => {
        try {
            dispatch(startLoading()); // Bật hiệu ứng loading
            const response = await axiosDefault.post("/auth/login", {
                phone,
                password,
            });
            const { access_token, refresh_token, account } = response.data;

            // Cập nhật Redux với token và account
            dispatch(loginSuccess({ access_token, refresh_token, account }));

            // Hiển thị thông báo thành công
            enqueueSnackbar("Đăng nhập thành công!", { variant: "success" });
        } catch (error) {
            enqueueSnackbar(error.response.data.message, {
                variant: "error",
            });
        } finally {
            dispatch(stopLoading()); // Tắt hiệu ứng loading
        }
    };

    return (
        <div>
            <input
                type="text"
                placeholder="Phone"
                value={phone}
                onChange={(e) => setPhone(e.target.value)}
                disabled={isLoading}
            />
            <input
                type="password"
                placeholder="Password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                disabled={isLoading}
            />
            <Button
                variant="contained"
                onClick={handleLogin}
                loading={isLoading}
            >
                Đăng nhập
            </Button>
        </div>
    );
};

export default Login;
