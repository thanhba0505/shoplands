import axios from "axios";
import store from "~/redux/store";
import { logout, refreshTokenSuccess } from "~/redux/authSlice";
import { enqueueSnackbar } from "notistack"; // Hiển thị thông báo lỗi
import Api from "~/helpers/Api";
import Path from "~/helpers/Path";

// Tạo axios instance với base URL
const axiosWithAuth = axios.create({
  baseURL: import.meta.env.VITE_API_URL + "/api",
  headers: {
    "Content-Type": "application/json",
  },
});

const axiosRefresh = axios.create({
  baseURL: import.meta.env.VITE_API_URL + "/api",
  headers: {
    "Content-Type": "application/json",
  },
});

// 🛠 Interceptor để thêm Authorization header với access token vào mỗi request
axiosWithAuth.interceptors.request.use(
  (config) => {
    const token = store.getState().auth.accessToken;
    if (token) {
      config.headers["Authorization"] = `Bearer ${token}`;
    }
    return config;
  },
  (error) => Promise.reject(error)
);

// 🛠 Interceptor để tự động xử lý lỗi và refresh token nếu cần
axiosWithAuth.interceptors.response.use(
  (response) => response, // ✅ Thành công, trả về response bình thường

  async (error) => {
    const originalRequest = error.config;

    // Lấy navigate từ config
    const navigate = originalRequest?.navigate;

    // 🔴 Xử lý lỗi mất kết nối mạng
    if (!error.response) {
      enqueueSnackbar("Không thể kết nối đến server. Vui lòng kiểm tra mạng!", {
        variant: "error",
      });
      return Promise.reject(error);
    }

    // 🔴 Xử lý lỗi token hết hạn (401 Unauthorized)
    if (error.response?.status === 401 && !originalRequest._retry) {
      originalRequest._retry = true;

      try {
        const refreshToken = store.getState().auth.refreshToken;
        if (!refreshToken) {
          enqueueSnackbar(
            "Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại!",
            { variant: "warning" }
          );
          store.dispatch(logout());
          if (navigate) navigate(Path.login()); // Navigate to login page
          return Promise.reject(error);
        }

        // 🔄 Refresh token
        const res = await axiosRefresh.post(Api.refreshToken(), {
          refresh_token: refreshToken,
        });

        // 🔥 Cập nhật Redux với token mới
        store.dispatch(refreshTokenSuccess(res.data));

        // 🔄 Gửi lại request với token mới
        originalRequest.headers[
          "Authorization"
        ] = `Bearer ${res.data.access_token}`;
        return axiosWithAuth(originalRequest);
      } catch (refreshError) {
        enqueueSnackbar("Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại!", {
          variant: "error",
        });
        store.dispatch(logout());
        if (navigate) navigate(Path.login()); // Navigate to login page
        return Promise.reject(refreshError);
      }
    }

    // 🔴 Tự động hiển thị lỗi từ API
    if (error.response?.data?.message) {
      enqueueSnackbar(error.response.data.message, { variant: "error" });
    } else {
      enqueueSnackbar("Đã xảy ra lỗi, vui lòng thử lại!", {
        variant: "error",
      });
    }

    return Promise.reject(error);
  }
);

export default axiosWithAuth;
