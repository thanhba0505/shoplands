import {
    createBrowserRouter,
    RouterProvider,
    createRoutesFromElements,
    Route,
    Navigate,
} from "react-router-dom";
import { publicRoutes, userRoutes, sellerRoutes, adminRoutes } from "~/routes";
import DefaultLayout from "~/components/layout/DefaultLayout";
import ProtectedRoute from "~/components/ProtectedRoute";
import LoadingScreen from "~/components/LoadingScreen";
import Path from "./helpers/Path";
import { useSnackbar } from "notistack";
import { useEffect } from "react";

// 🔹 Component xử lý Not Found (404)
const NotFoundRedirect = () => {
    const { enqueueSnackbar } = useSnackbar();

    useEffect(() => {
        enqueueSnackbar("Trang bạn yêu cầu không tồn tại!", {
            variant: "error",
        });
    }, [enqueueSnackbar]);

    return <Navigate to={Path.home()} replace />;
};

// 🔹 Hàm render routes (Tách nhỏ route có `*`)
const renderRoutes = (routes, role = null) => {
    return routes.map((route, index) => {
        const Page = route.component;
        const Layout = route.layout || DefaultLayout;

        if (route.path.includes("*")) {
            // 🔥 Sửa lỗi `v7_relativeSplatPath` bằng cách tách route cha & route con
            return (
                <Route key={index} path={route.path.replace("/*", "")}>
                    <Route
                        index
                        element={
                            <Layout>
                                <Page />
                            </Layout>
                        }
                    />
                    <Route
                        path="*"
                        element={
                            <Layout>
                                <Page />
                            </Layout>
                        }
                    />
                </Route>
            );
        }

        return (
            <Route
                key={index}
                path={route.path}
                element={
                    role ? (
                        <ProtectedRoute role={role}>
                            <Layout>
                                <Page />
                            </Layout>
                        </ProtectedRoute>
                    ) : (
                        <Layout>
                            <Page />
                        </Layout>
                    )
                }
            />
        );
    });
};

// 🔹 Khởi tạo Router với tất cả Future Flags
const router = createBrowserRouter(
    createRoutesFromElements(
        <>
            {renderRoutes(publicRoutes)}
            {renderRoutes(userRoutes, "user")}
            {renderRoutes(sellerRoutes, "seller")}
            {renderRoutes(adminRoutes, "admin")}
            <Route path="*" element={<NotFoundRedirect />} />
        </>
    ),
    {
        future: {
            v7_startTransition: true, // ✅ Cải thiện hiệu suất với `startTransition`
            v7_relativeSplatPath: true, // ✅ Sửa lỗi path chứa `*`
            v7_fetcherPersist: true, // ✅ Giữ dữ liệu `useFetcher()` lâu hơn
            v7_normalizeFormMethod: true, // ✅ Đảm bảo `formMethod` luôn là chữ hoa
            v7_partialHydration: true, // ✅ Hỗ trợ SSR tốt hơn (nếu dùng)
            v7_skipActionErrorRevalidation: true, // ✅ Tránh reload không cần thiết nếu action lỗi
        },
    }
);

// 🔹 Component App chính
const App = () => {
    return (
        <>
            <LoadingScreen />
            <RouterProvider router={router} />
        </>
    );
};

export default App;
