import { useTheme } from "@emotion/react";
import {
  Box,
  Checkbox,
  Container,
  FormControl,
  Grid2,
  InputAdornment,
  InputLabel,
  List,
  ListItem,
  ListItemButton,
  ListItemIcon,
  ListItemText,
  MenuItem,
  Select,
  Slider,
  TextField,
  Typography,
} from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import CircularProgressLoading from "~/components/CircularProgressLoading";
import PaperCustom from "~/components/PaperCustom";
import ShowProducts from "~/components/ShowProducts";
import TablePaginationCustom from "~/components/TablePaginationCustom";
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
  const [price, setPrice] = useState([min, min + minDistance]); // Đổi từ value2 thành price

  const handleChange2 = (event, newValue, activeThumb) => {
    if (newValue[1] - newValue[0] < minDistance) {
      if (activeThumb === 0) {
        const clamped = Math.min(newValue[0], price[1] - minDistance);
        setPrice([clamped, clamped + minDistance]);
      } else {
        const clamped = Math.max(newValue[1], price[0] + minDistance);
        setPrice([clamped - minDistance, clamped]);
      }
    } else {
      setPrice([
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
          value={price[0]} // Đổi từ value2[0] thành price[0]
          onChange={(e) => {
            const newValue = Math.max(
              min,
              Math.min(Number(e.target.value) || 0, price[1] - minDistance)
            );
            setPrice([newValue, price[1]]); // Đổi từ value2 thành price
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
          value={price[1]} // Đổi từ value2[1] thành price[1]
          onChange={(e) => {
            const newValue = Math.max(min, Math.min(e.target.value, max));
            setPrice([price[0], newValue]); // Đổi từ value2 thành price
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
          value={price} // Đổi từ value2 thành price
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
  const [loadingCategories, setLoadingCategories] = useState(false);
  const [categories, setCategories] = useState([]);
  const [checkedCategories, setCheckedCategories] = useState([]);
  const [orderByPrice, setOrderByPrice] = useState("");
  const [orderByRating, setOrderByRating] = useState("");

  const [products, setProducts] = useState([]);
  const [count, setCount] = useState(0);
  const [page, setPage] = useState(0);
  const [rowsPerPage, setRowsPerPage] = useState(20);
  const [loading, setLoading] = useState(false);

  const fetchCategories = useCallback(async () => {
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

  const fetchProducts = useCallback(
    async (page = 0, limit = 20) => {
      setLoading(true);
      try {
        const response = await axiosDefault.get(Api.products(), {
          params: {
            limit: limit,
            page: page + 1, // Cộng thêm 1 nếu API của bạn yêu cầu phân trang bắt đầu từ 1
            order_by_price: orderByPrice,
            order_by_rating: orderByRating,
            categories: checkedCategories,
          },
        });

        setProducts(response.data.products);
        setCount(response.data.count);
      } catch (error) {
        Log.error(error.response?.data?.message);
      } finally {
        setLoading(false);
      }
    },
    [checkedCategories, orderByPrice, orderByRating]
  );

  const [timeoutId, setTimeoutId] = useState(null);

  useEffect(() => {
    fetchCategories();
  }, [fetchCategories]);

  useEffect(() => {
    if (timeoutId) {
      clearTimeout(timeoutId);
    }

    const newTimeoutId = setTimeout(() => {
      fetchProducts(page, rowsPerPage);
    }, 400); // Đặt thời gian debounce là 300ms

    setTimeoutId(newTimeoutId);

    return () => {
      if (newTimeoutId) {
        clearTimeout(newTimeoutId);
      }
    };

    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [
    checkedCategories,
    orderByPrice,
    orderByRating,
    page,
    rowsPerPage,
    fetchProducts,
  ]);

  const handleChangePage = (event, newPage) => {
    setPage(newPage);
  };

  const handleChangeRowsPerPage = (event) => {
    const newRowsPerPage = parseInt(event.target.value, 10);
    setRowsPerPage(newRowsPerPage);
    setPage(0); // Reset page khi thay đổi số dòng mỗi trang
  };

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
          <PaperCustom>
            <Grid2
              container
              spacing={2}
              alignItems={"center"}
              sx={{ mt: 2, mb: 1 }}
            >
              <Grid2 size={"auto"}>
                <FormControl size="small">
                  <InputLabel
                    id="demo-select-small-label"
                    sx={{ backgroundColor: "white", pr: 1 }}
                  >
                    Sắp xếp theo giá
                  </InputLabel>
                  <Select
                    labelId="demo-select-small-label"
                    id="demo-select-small"
                    value={orderByPrice}
                    label="price"
                    onChange={(e) => setOrderByPrice(e.target.value)}
                    sx={{ minWidth: "170px" }}
                  >
                    <MenuItem value="">
                      <em>Không</em>
                    </MenuItem>
                    <MenuItem value={"asc"}>Giá thấp trước</MenuItem>
                    <MenuItem value={"desc"}>Giá cao trước</MenuItem>
                  </Select>
                </FormControl>
              </Grid2>
              <Grid2 size={"auto"}>
                <FormControl size="small">
                  <InputLabel
                    id="demo-select-small-label"
                    sx={{ backgroundColor: "white", pr: 1 }}
                  >
                    Sắp xếp theo đánh giá
                  </InputLabel>
                  <Select
                    labelId="demo-select-small-label"
                    id="demo-select-small"
                    value={orderByRating}
                    label="rating"
                    onChange={(e) => setOrderByRating(e.target.value)}
                    sx={{ minWidth: "220px" }}
                  >
                    <MenuItem value="">
                      <em>Không</em>
                    </MenuItem>
                    <MenuItem value={"asc"}>Đánh giá thấp trước</MenuItem>
                    <MenuItem value={"desc"}>Đánh giá cao trước</MenuItem>
                  </Select>
                </FormControl>
              </Grid2>
              <Grid2 size={"auto"} ml={"auto"}>
                <TablePaginationCustom
                  loading={loading}
                  count={count}
                  page={page}
                  rowsPerPage={rowsPerPage}
                  handleChangePage={handleChangePage}
                  handleChangeRowsPerPage={handleChangeRowsPerPage}
                  labelRowsPerPage="Số sản phẩm mỗi trang"
                  rowsPerPageOptions={[20, 50, 100]} // Các giá trị mặc định cho số phần tử mỗi trang
                />
              </Grid2>
              <Grid2 size={12} sx={{ mt: 1 }}>
                {loading ? (
                  <CircularProgressLoading sx={{ height: 400 }} />
                ) : (
                  <ShowProducts products={products} columns={10} />
                )}
              </Grid2>{" "}
              <Grid2 size={12}>
                <TablePaginationCustom
                  loading={loading}
                  count={count}
                  page={page}
                  rowsPerPage={rowsPerPage}
                  handleChangePage={handleChangePage}
                  handleChangeRowsPerPage={handleChangeRowsPerPage}
                  labelRowsPerPage="Số sản phẩm mỗi trang"
                  rowsPerPageOptions={[20, 50, 100]} // Các giá trị mặc định cho số phần tử mỗi trang
                />
              </Grid2>
            </Grid2>
          </PaperCustom>
        </Grid2>
      </Grid2>
    </Container>
  );
};

export default Products;
