import { extendTheme } from "@mui/material/styles";

// Create a theme instance.
const theme = extendTheme({
    custom: {
        headerHeight: "74px",
        paddingYContainer: "20px",
        boxShadow: "0px 3px 8px #bfe2ff",
    },
});

export default theme;
