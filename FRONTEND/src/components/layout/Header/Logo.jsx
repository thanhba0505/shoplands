import { Box, Typography } from "@mui/material";
import { useTheme } from "@mui/material/styles";

const Logo = () => {
    const theme = useTheme();

    return (
        <Box sx={{ display: "flex", alignItems: "center" }}>
            <Typography
                variant="h6"
                sx={{
                    fontWeight: "bold",
                    color: theme.palette.primary.main,
                }}
            >
                MyLogo
            </Typography>
        </Box>
    );
};

export default Logo;
