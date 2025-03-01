import { useSelector } from "react-redux";
import CircularProgress from "@mui/material/CircularProgress";
import Box from "@mui/material/Box";
import Backdrop from "@mui/material/Backdrop";

const LoadingScreen = () => {
    const isLoading = useSelector((state) => state.loading.isLoading);

    return (
        <Backdrop
            sx={{ color: "#fff", zIndex: (theme) => theme.zIndex.drawer + 1 }}
            open={isLoading}
        >
            <Box
                sx={{
                    backgroundColor: "white",
                    padding: "50px",
                    borderRadius: "12px",
                    display: "flex",
                    flexDirection: "column",
                    alignItems: "center",
                    boxShadow: 3,
                    position: "absolute",
                    top: "40%",
                    left: "50%",
                    transform: "translate(-50%, -50%)",
                }}
            >
                <CircularProgress color="primary" size={50} />
            </Box>
        </Backdrop>
    );
};

export default LoadingScreen;
