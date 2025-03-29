import { useTheme } from "@emotion/react";
import {
  Box,
  Checkbox,
  Container,
  Grid2,
  InputAdornment,
  List,
  ListItem,
  ListItemButton,
  ListItemIcon,
  ListItemText,
  Slider,
  TextField,
  Typography,
} from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import CircularProgressLoading from "~/components/CircularProgressLoading";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import axiosDefault from "~/utils/axiosDefault";

const Categories = ({
  categories,
  loadingCategories,
  checkedCategories,
  handleToggle,
}) => {
  const theme = useTheme();

  return (
    <>
      <Box
        sx={{
          userSelect: "none",
          px: 2,
          mt: 1,
        }}
      >
        <Typography variant="body2" sx={{ py: 1 }} noWrap>
          Danh mục
        </Typography>
      </Box>
      {loadingCategories ? (
        <CircularProgressLoading sx={{ height: 400 }} />
      ) : (
        categories.map((category) => (
          <ListItem
            key={category.id}
            sx={{
              borderRadius: "8px",
              overflow: "hidden",
              my: 0.5,
              height: "48px",
              backgroundColor: checkedCategories.includes(category.id)
                ? theme.custom.primary.strongLight
                : "transparent",
            }}
            disablePadding
            onClick={handleToggle(category.id)}
          >
            <ListItemButton>
              <ListItemIcon sx={{ minWidth: "40px" }}>
                <Checkbox
                  edge="start"
                  checked={checkedCategories.includes(category.id)}
                  tabIndex={-1}
                  disableRipple
                />
              </ListItemIcon>

              <ListItemText primary={category.name} />
            </ListItemButton>
          </ListItem>
        ))
      )}
    </>
  );
};

const min = 0;
const max = 5000000;
const minDistance = 100000;

const Price = () => {
  const [value2, setValue2] = useState([min, min + minDistance]);

  const handleChange2 = (event, newValue, activeThumb) => {
    if (newValue[1] - newValue[0] < minDistance) {
      if (activeThumb === 0) {
        // Nếu thanh trượt trái được thay đổi, giữ khoảng cách với thanh trượt phải
        const clamped = Math.min(newValue[0], value2[1] - minDistance);
        setValue2([clamped, clamped + minDistance]);
      } else {
        // Nếu thanh trượt phải được thay đổi, giữ khoảng cách với thanh trượt trái
        const clamped = Math.max(newValue[1], value2[0] + minDistance);
        setValue2([clamped - minDistance, clamped]);
      }
    } else {
      // Cập nhật giá trị nếu khoảng cách giữa min và max hợp lệ
      setValue2([
        Math.max(min, Math.min(newValue[0], max)),
        Math.max(min, Math.min(newValue[1], max)),
      ]);
    }
  };

  return (
    <>
      <Box
        sx={{
          userSelect: "none",
          px: 2,
        }}
      >
        <Typography variant="body2" sx={{ py: 1 }} noWrap>
          Giá
        </Typography>
      </Box>
      <Box
        sx={{
          mt: 2,
          px: 2,
        }}
      >
        <TextField
          variant="outlined"
          autoComplete="off"
          type="number"
          label="Min"
          placeholder="10000"
          size="small"
          fullWidth
          value={value2[0]}
          onChange={(e) => {
            const newValue = Math.max(
              min,
              Math.min(e.target.value, value2[1] - minDistance)
            );
            setValue2([newValue, value2[1]]);
          }}
          slotProps={{
            input: {
              endAdornment: <InputAdornment position="end">đ</InputAdornment>,
            },
          }}
        />
        <TextField
          sx={{ mt: 3 }}
          variant="outlined"
          autoComplete="off"
          type="number"
          label="Max"
          placeholder="100000"
          size="small"
          fullWidth
          value={value2[1]}
          onChange={(e) => {
            const newValue = Math.max(min, Math.min(e.target.value, max));
            setValue2([value2[0], newValue]);
          }}
          slotProps={{
            input: {
              endAdornment: <InputAdornment position="end">đ</InputAdornment>,
            },
          }}
        />
      </Box>
      <Box sx={{ px: 3 }}>
        <Slider
          sx={{ mt: 2 }}
          getAriaLabel={() => "Minimum distance shift"}
          value={value2}
          onChange={handleChange2}
          valueLabelDisplay="auto"
          valueLabelFormat={(value) => Format.formatCurrency(value)}
          disableSwap
          step={minDistance}
          min={min}
          max={max}
        />
      </Box>
    </>
  );
};

const Products = () => {
  const [categories, setCategories] = useState([]);
  const [loadingCategories, setLoadingCategories] = useState(false);
  const [checkedCategories, setCheckedCategories] = useState([0]);

  const theme = useTheme();

  const fetchCarts = useCallback(async () => {
    setLoadingCategories(true);
    try {
      const response = await axiosDefault.get(Api.categories());
      setCategories(response.data);
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoadingCategories(false);
    }
  }, []);

  useEffect(() => {
    fetchCarts();
  }, [fetchCarts]);

  const handleToggle = (value) => () => {
    const currentIndex = checkedCategories.indexOf(value);
    const newChecked = [...checkedCategories];

    if (currentIndex === -1) {
      newChecked.push(value);
    } else {
      newChecked.splice(currentIndex, 1);
    }

    setCheckedCategories(newChecked);
  };

  return (
    <Container maxWidth="xl">
      <Grid2 container spacing={2} columns={10}>
        <Grid2 size={2}>
          <PaperCustom
            sx={{
              display: "flex",
              flexDirection: "column",
              justifyContent: "space-between",
              gap: 2,
              height: `calc(100vh - ${theme.custom.headerHeight} - 2 * ${theme.custom.containerGap})`,
              pr: 0,
            }}
          >
            <Box
              sx={{
                pr: 2,
                overflowY: "auto",
              }}
            >
              <List disablePadding>
                <Price />
                <Categories
                  categories={categories}
                  loadingCategories={loadingCategories}
                  checkedCategories={checkedCategories}
                  handleToggle={handleToggle}
                />
              </List>
            </Box>
          </PaperCustom>
        </Grid2>
        <Grid2 size={8}>
          <PaperCustom sx={{ height: "500px" }}>ádlfj</PaperCustom>
        </Grid2>
      </Grid2>
    </Container>
  );
};

export default Products;
