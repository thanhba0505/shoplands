import {
    BrowserRouter as Router,
    Routes,
    Route,
    Navigate,
} from "react-router-dom";
import { publicRoutes, userRoutes, sellerRoutes, adminRoutes } from "~/routes";
import DefaultLayout from "~/components/layout/DefaultLayout";
import ProtectedRoute from "~/components/ProtectedRoute"; // Import ProtectedRoute
import LoadingScreen from "~/components/LoadingScreen";
import Url from "./helpers/Url";
import { useSnackbar } from "notistack";
import { useEffect } from "react";

const NotFoundRedirect = () => {
    const { enqueueSnackbar } = useSnackbar();

    useEffect(() => {
        enqueueSnackbar("Trang bạn yêu cầu không tồn tại!", {
            variant: "error",
        });
    }, [enqueueSnackbar]);

    return <Navigate to={Url.home()} replace />;
};

const App = () => {
    const renderRoutes = (routes, role = null) => {
        return routes.map((route, index) => {
            const Page = route.component;
            const Layout = route.layout || DefaultLayout;

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

    return (
        <Router>
            <LoadingScreen />
            <Routes>
                {renderRoutes(publicRoutes)}
                {renderRoutes(userRoutes, "user")}
                {renderRoutes(sellerRoutes, "seller")}
                {renderRoutes(adminRoutes, "admin")}

                {/* Route không tồn tại */}
                <Route path="*" element={<NotFoundRedirect />} />
            </Routes>
        </Router>
    );
};

export default App;
