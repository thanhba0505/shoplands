import { Navigate } from "react-router-dom";
import { useSnackbar } from "notistack";
import Auth from "~/helpers/Auth";
import { useEffect } from "react";

const ProtectedRoute = ({ children, role }) => {
    const { enqueueSnackbar } = useSnackbar();

    useEffect(() => {
        if (role === "user" && !Auth.checkUser()) {
            enqueueSnackbar("Bạn không có quyền truy cập vào trang này!", {
                variant: "error",
            });
        }
        if (role === "seller" && !Auth.checkSeller()) {
            enqueueSnackbar("Bạn không có quyền truy cập vào trang này!", {
                variant: "error",
            });
        }
        if (role === "admin" && !Auth.checkAdmin()) {
            enqueueSnackbar("Bạn không có quyền truy cập vào trang này!", {
                variant: "error",
            });
        }
    }, [role, enqueueSnackbar]);

    if (role === "user" && !Auth.checkUser()) {
        return <Navigate to="/" replace />;
    }
    if (role === "seller" && !Auth.checkSeller()) {
        return <Navigate to="/" replace />;
    }
    if (role === "admin" && !Auth.checkAdmin()) {
        return <Navigate to="/" replace />;
    }

    return children;
};

export default ProtectedRoute;
