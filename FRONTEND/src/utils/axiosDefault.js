import axios from "axios";

const axiosDefault = axios.create({
    baseURL: "http://localhost/code-php/shopee/BACKEND/api",
    headers: {
        "Content-Type": "application/json",
    },
});

export default axiosDefault;
