import { useSelector } from "react-redux";
import LinearProgress from "@mui/material/LinearProgress";
import Box from "@mui/material/Box";
import { useState, useEffect } from "react";

const UPDATE_INTERVAL = 50; // 🔥 Tốc độ cập nhật tiến trình (ms)
const MAX_PROGRESS = 100; // 🔥 Giá trị tối đa của progress
const FADE_DURATION = 500; // 🔥 Thời gian hiệu ứng mờ dần (ms)

const LoadingScreen = () => {
    const isLoading = useSelector((state) => state.loading.isLoading);
    const [progress, setProgress] = useState(0);
    const [visible, setVisible] = useState(false);
    const [fade, setFade] = useState(false); // 🔥 Trạng thái fade in/out

    useEffect(() => {
        let progressInterval;

        if (isLoading) {
            setVisible(true);
            setFade(true); // 🔥 Hiển thị mượt mà (fade in)
            setProgress(0); // Reset về 0%

            // 🔄 Cập nhật tiến trình dần dần, dừng lại ở 90% nếu vẫn đang loading
            progressInterval = setInterval(() => {
                setProgress((prevProgress) =>
                    prevProgress >= 75 ? prevProgress : prevProgress + 5
                );
            }, UPDATE_INTERVAL);
        } else {
            // ✅ Khi isLoading = false, hoàn thành lên 100% rồi mới ẩn
            progressInterval = setInterval(() => {
                setProgress((prevProgress) => {
                    if (prevProgress >= MAX_PROGRESS) {
                        clearInterval(progressInterval);

                        setTimeout(() => setFade(false), 200); // 🔥 Bắt đầu fade out
                        setTimeout(() => setVisible(false), FADE_DURATION); // 🔥 Ẩn hoàn toàn sau khi fade
                        return MAX_PROGRESS;
                    }
                    return prevProgress + 10;
                });
            }, UPDATE_INTERVAL);
        }

        return () => clearInterval(progressInterval);
    }, [isLoading]);

    return (
        <>
            {visible && (
                <Box
                    sx={{
                        position: "fixed",
                        top: 0,
                        left: 0,
                        width: "100%",
                        zIndex: 9999,
                        opacity: fade ? 1 : 0, // 🔥 Điều khiển fade in/out
                        transition: `opacity ${FADE_DURATION}ms ease-in-out`, // 🔥 Hiệu ứng mờ dần
                    }}
                >
                    <LinearProgress
                        variant="determinate"
                        value={progress}
                        color="primary"
                    />
                </Box>
            )}
        </>
    );
};

export default LoadingScreen;
