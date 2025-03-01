import axios from "axios";
import { enqueueSnackbar } from "notistack";

const axiosDefault = axios.create({
    baseURL: import.meta.env.VITE_API_URL,
    headers: {
        "Content-Type": "application/json",
    },
    timeout: 10000,
});

// Xử lý lỗi chung trong Interceptor
axiosDefault.interceptors.response.use(
    (response) => response, // Trả về response nếu request thành công
    (error) => {
        if (!error.response) {
            enqueueSnackbar(
                "Không thể kết nối đến server. Vui lòng kiểm tra mạng!",
                { variant: "error" }
            );
            return Promise.reject(new Error("Network Error"));
        }

        // Hiển thị thông báo lỗi từ API
        if (error.response.data?.message) {
            enqueueSnackbar(error.response.data.message, { variant: "error" });
        }

        return Promise.reject(error); // Trả lỗi về để xử lý trong try...catch
    }
);

export default axiosDefault;
