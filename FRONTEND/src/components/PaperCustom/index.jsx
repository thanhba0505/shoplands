import { useTheme } from "@emotion/react";
import { Paper } from "@mui/material";

const PaperCustom = ({ children, sx, ...props }) => {
    const theme = useTheme();
    return (
        <Paper
            {...props}
            sx={{
                padding: 2,
                borderRadius: "12px",
                boxShadow: theme.custom?.boxShadow,
                backgroundColor: theme.palette.background.paper,
                ...sx,
            }}
        >
            {children}
        </Paper>
    );
};

export default PaperCustom;
