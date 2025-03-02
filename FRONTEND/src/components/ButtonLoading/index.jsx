import { useState, useEffect } from "react";
import { Button } from "@mui/material";

const MIN_LOADING_TIME = 500; // 🔥 Thời gian tối thiểu (ms)

const ButtonLoading = ({ loading, children, ...props }) => {
    const [internalLoading, setInternalLoading] = useState(false);

    useEffect(() => {
        let timer;
        if (loading) {
            setInternalLoading(true); // 🔥 Hiển thị loading ngay lập tức
        } else {
            timer = setTimeout(
                () => setInternalLoading(false),
                MIN_LOADING_TIME
            ); // 🔥 Đảm bảo loading tối thiểu
        }
        return () => clearTimeout(timer);
    }, [loading]);

    return (
        <Button {...props} loading={internalLoading}>
            {children}
        </Button>
    );
};

export default ButtonLoading;
