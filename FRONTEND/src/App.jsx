import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import { routes } from "~/routes";
import DefaultLayout from "~/components/layout/DefaultLayout";

const App = () => {
    return (
        <Router>
            <Routes>
                {routes.map((route, index) => {
                    const Page = route.component;
                    let Layout = DefaultLayout;

                    if (route.layout) {
                        Layout = route.layout;
                    }

                    return (
                        <Route
                            key={index}
                            path={route.path}
                            element={
                                <Layout>
                                    <Page />
                                </Layout>
                            }
                            // Sử dụng future flag v7_startTransition
                            future={{ v7_startTransition: true }}
                        />
                    );
                })}
            </Routes>
        </Router>
    );
};

export default App;
