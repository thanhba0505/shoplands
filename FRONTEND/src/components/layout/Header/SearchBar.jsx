import { Box, InputBase } from "@mui/material";
import { Search } from "@mui/icons-material";
import { useTheme } from "@mui/material/styles";

const SearchBar = () => {
    const theme = useTheme();

    return (
        <Box
            sx={{
                display: "flex",
                alignItems: "center",
                bgcolor: "#fff",
                border: `2px solid ${theme.palette.primary.light}`,
                borderRadius: "20px",
                padding: "5px 10px",
                width: "300px",
                transition: "border-color 0.3s ease-in-out",
                "&:hover": {
                    borderColor: theme.palette.primary.main,
                },
            }}
        >
            <Search
                sx={{
                    marginRight: "8px",
                    color: theme.palette.text.secondary,
                }}
            />
            <InputBase
                placeholder="Tìm kiếm..."
                autoComplete="off"
                sx={{
                    flex: 1,
                    color: theme.palette.text.secondary,
                }}
            />
        </Box>
    );
};

export default SearchBar;
