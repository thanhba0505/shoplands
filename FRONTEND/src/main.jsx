import ReactDOM from "react-dom/client";
import CssBaseline from "@mui/material/CssBaseline";
import { ThemeProvider } from "@mui/material/styles";

import App from "~/App.jsx";
import theme from "~/theme.js";
import { Provider } from "react-redux";
import store, { persistor } from "~/redux/store";
import { PersistGate } from "redux-persist/integration/react";
import SnackbarProviderCustom from "./components/SnackbarProviderCustom";
import Favicon from "./components/Favicon";

import { GoogleOAuthProvider } from "@react-oauth/google";

ReactDOM.createRoot(document.getElementById("root")).render(
  <>
    {/* <React.StrictMode> */}
    <Favicon />
    <GoogleOAuthProvider clientId={import.meta.env.VITE_GOOGLE_CLIENT_ID}>
      <ThemeProvider theme={theme}>
        <CssBaseline />
        <Provider store={store}>
          <PersistGate loading={null} persistor={persistor}>
            <SnackbarProviderCustom>
              <App />
            </SnackbarProviderCustom>
          </PersistGate>
        </Provider>
      </ThemeProvider>
    </GoogleOAuthProvider>
    {/* </React.StrictMode> */}
  </>
);
