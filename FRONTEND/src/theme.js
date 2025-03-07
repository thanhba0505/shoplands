import { extendTheme } from "@mui/material/styles";

// Create a theme instance.
const theme = extendTheme({
  custom: {
    headerHeight: "80px",
    containerGap: "24px",
    boxShadow: "0px 0px 8px #bfe2ff",
    primary: {
      light: "#bfe2ff",
    },
  },
});

export default theme;
