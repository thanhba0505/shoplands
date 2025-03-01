import axios from "axios";
import store from "~/redux/store";
import { logout, refreshTokenSuccess } from "~/redux/authSlice";

// Tạo axios instance với base URL
const axiosWithAuth = axios.create({
    baseURL: "http://localhost/code-php/shopee/BACKEND/api",
    headers: {
        "Content-Type": "application/json",
    },
});

// Interceptor để thêm Authorization header với access token vào mỗi request
axiosWithAuth.interceptors.request.use(
    (config) => {
        const token = store.getState().auth.accessToken; // 🔥 Lấy từ Redux
        if (token) {
            config.headers["Authorization"] = `Bearer ${token}`;
        }
        return config;
    },
    (error) => Promise.reject(error)
);

// Interceptor để tự động refresh token khi gặp lỗi 401 (Hết hạn token)
axiosWithAuth.interceptors.response.use(
    (response) => response,
    async (error) => {
        const originalRequest = error.config;
        if (
            error.response &&
            error.response.status === 401 &&
            !originalRequest._retry
        ) {
            originalRequest._retry = true;

            try {
                const refreshToken = store.getState().auth.refreshToken; // 🔥 Lấy từ Redux
                if (!refreshToken) {
                    store.dispatch(logout());
                    return Promise.reject(error);
                }

                const res = await axiosWithAuth.post("/auth/refresh-token", {
                    refresh_token: refreshToken,
                });

                // Cập nhật Redux và localStorage
                store.dispatch(refreshTokenSuccess(res.data));

                // Thực hiện lại request ban đầu với token mới
                originalRequest.headers[
                    "Authorization"
                ] = `Bearer ${res.data.access_token}`;
                return axiosWithAuth(originalRequest);
            } catch (refreshError) {
                store.dispatch(logout());
                return Promise.reject(refreshError);
            }
        }
        return Promise.reject(error);
    }
);

export default axiosWithAuth;
