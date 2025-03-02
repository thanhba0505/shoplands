import { experimental_extendTheme as extendTheme } from "@mui/material/styles";

// Create a theme instance.
const theme = extendTheme({
    custom: {
        headerHeight: "74px",
        paddingYContainer: "20px",
    },
});

export default theme;
