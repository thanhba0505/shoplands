import axios from "axios";
import { enqueueSnackbar } from "notistack";

const axiosDefaultNoEnq = axios.create({
    baseURL: import.meta.env.VITE_API_URL + "/api",
    headers: {
        "Content-Type": "application/json",
    },
    timeout: 10000,
});

// Xử lý lỗi chung trong Interceptor
axiosDefaultNoEnq.interceptors.response.use(
    (response) => response, // Trả về response nếu request thành công
    (error) => {
        if (!error.response) {
            enqueueSnackbar(
                "Không thể kết nối đến server. Vui lòng kiểm tra mạng!",
                { variant: "error" }
            );
            return Promise.reject(new Error("Network Error"));
        }

        return Promise.reject(error); // Trả lỗi về để xử lý trong try...catch
    }
);

export default axiosDefaultNoEnq;
