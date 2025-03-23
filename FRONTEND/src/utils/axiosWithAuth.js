import axios from "axios";
import store from "~/redux/store";
import { logout, refreshTokenSuccess } from "~/redux/authSlice";
import { enqueueSnackbar } from "notistack";
import Api from "~/helpers/Api";
import Path from "~/helpers/Path";
import { setRefreshing } from "~/redux/tokenSlice";

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

axiosWithAuth.interceptors.response.use(
  (response) => response,
  async (error) => {
    const originalRequest = error.config;
    const navigate = originalRequest?.navigate;
    const state = store.getState();

    if (!error.response) {
      enqueueSnackbar("Không thể kết nối đến server. Vui lòng kiểm tra mạng!", {
        variant: "error",
      });
      return Promise.reject(error);
    }

    if (error.response?.status === 401 && !originalRequest._retry) {
      originalRequest._retry = true;

      // Kiểm tra trạng thái isRefreshing trong Redux
      if (state.token.isRefreshing) {
        // Nếu đang refresh token, đừng làm gì thêm
        return Promise.reject(error);
      }

      store.dispatch(setRefreshing(true)); // Đặt trạng thái isRefreshing là true

      try {
        const refreshToken = state.auth.refreshToken;
        if (!refreshToken) {
          enqueueSnackbar("Bạn chưa đăng nhập!", { variant: "error" });
          store.dispatch(logout());
          if (navigate) navigate(Path.login());
          return Promise.reject(error);
        }

        const res = await axiosRefresh.post(Api.refreshToken(), {
          refresh_token: refreshToken,
        });

        store.dispatch(refreshTokenSuccess(res.data));

        originalRequest.headers[
          "Authorization"
        ] = `Bearer ${res.data.access_token}`;
        store.dispatch(setRefreshing(false)); // Đặt trạng thái isRefreshing là false sau khi refresh xong
        return axiosWithAuth(originalRequest);
      } catch (refreshError) {
        enqueueSnackbar("Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại!", {
          variant: "error",
        });
        store.dispatch(logout());
        if (navigate) navigate(Path.login());
        store.dispatch(setRefreshing(false)); // Đặt trạng thái isRefreshing là false khi có lỗi
        return Promise.reject(refreshError);
      }
    }

    // Xử lý các lỗi khác
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
