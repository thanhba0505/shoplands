import { Box, InputBase } from "@mui/material";
import { Search } from "@mui/icons-material";
import { useTheme } from "@mui/material/styles";
import { useState } from "react";
import { useNavigate } from "react-router-dom";
import Path from "~/helpers/Path";

const SearchBar = () => {
  const theme = useTheme();
  const navigate = useNavigate();

  const [search, setSearch] = useState("");

  const handleSearch = () => {
    let url = Path.products()
    if (search) {
      url += `?search=${search}`
    }
    navigate(url);
    setSearch("");
  };

  const path = window.location.pathname;

  const element = Path.getElement(path, 1);

  return (
    <Box
      sx={{
        display: "flex",
        visibility: element === "products" ? "hidden" : "visible",
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
        height: "50px",
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
        value={search}
        onChange={(e) => setSearch(e.target.value)}
        onKeyDown={(e) => {
          if (e.key === "Enter") {
            handleSearch();
          }
        }}
      />
    </Box>
  );
};

export default SearchBar;
