import { useTheme } from "@emotion/react";
import {
  Box,
  Checkbox,
  Container,
  FormControl,
  Grid2,
  InputLabel,
  List,
  ListItem,
  ListItemButton,
  ListItemIcon,
  ListItemText,
  MenuItem,
  Select,
  Skeleton,
  TextField,
  Typography,
} from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import { useLocation } from "react-router-dom";
import ButtonLoading from "~/components/ButtonLoading";
import NoContent from "~/components/NoContent";
import PaperCustom from "~/components/PaperCustom";
import ShowProducts from "~/components/ShowProducts";
import SkeletonProducts from "~/components/SkeletonProducts";
import TablePaginationCustom from "~/components/TablePaginationCustom";
import Api from "~/helpers/Api";
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
        <Box>
          <Skeleton height={40} width={"100%"} sx={{ mb: 1.6, my: 1, px: 2 }} />
          <Skeleton height={40} width={"100%"} sx={{ mb: 1.6, my: 1, px: 2 }} />
          <Skeleton height={40} width={"100%"} sx={{ mb: 1.6, my: 1, px: 2 }} />
          <Skeleton height={40} width={"100%"} sx={{ mb: 1.6, my: 1, px: 2 }} />
          <Skeleton height={40} width={"100%"} sx={{ mb: 1.6, my: 1, px: 2 }} />
          <Skeleton height={40} width={"100%"} sx={{ mb: 1.6, my: 1, px: 2 }} />
          <Skeleton height={40} width={"100%"} sx={{ mb: 1.6, my: 1, px: 2 }} />
          <Skeleton height={40} width={"100%"} sx={{ mb: 1.6, my: 1, px: 2 }} />
          <Skeleton height={40} width={"100%"} sx={{ mb: 1.6, my: 1, px: 2 }} />
          <Skeleton height={40} width={"100%"} sx={{ mb: 1.6, my: 1, px: 2 }} />
          <Skeleton height={40} width={"100%"} sx={{ mb: 1.6, my: 1, px: 2 }} />
          <Skeleton height={40} width={"100%"} sx={{ mb: 1.6, my: 1, px: 2 }} />
        </Box>
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

const Price = ({ price, setPrice }) => {
  const priceRanges = [
    { label: "Không", min: null, max: null },
    { label: "0 - 100,000", min: 0, max: 100000 },
    { label: "100,000 - 200,000", min: 100000, max: 200000 },
    { label: "200,000 - 500,000", min: 200000, max: 500000 },
    { label: "500,000 - 1,000,000", min: 500000, max: 1000000 },
    { label: "1,000,000 - 2,000,000", min: 1000000, max: 2000000 },
    { label: "2,000,000 - 5,000,000", min: 2000000, max: 5000000 },
    { label: "Hơn 5,000,000", min: 5000000, max: null },
  ];

  // Function to handle the change in range selection
  const handleChange = (event) => {
    const selectedRange = priceRanges.find(
      (range) => range.label === event.target.value
    );
    if (selectedRange) {
      setPrice([selectedRange.min, selectedRange.max]);
    }
  };

  return (
    <>
      <Box sx={{ userSelect: "none", px: 2 }}>
        <Typography variant="body2" sx={{ py: 1 }} noWrap>
          Giá
        </Typography>
      </Box>

      <Box sx={{ mt: 1 }}>
        <FormControl fullWidth size="small">
          <InputLabel
            id="demo-simple-select-label"
            sx={{ backgroundColor: "white", pr: 1 }}
          >
            Khoảng giá
          </InputLabel>
          <Select
            labelId="demo-simple-select-label"
            id="demo-simple-select"
            value={
              priceRanges.find(
                (range) => range.min === price[0] && range.max === price[1]
              )?.label || ""
            }
            label="Age"
            onChange={handleChange}
          >
            {priceRanges.map((range) => (
              <MenuItem key={range.label} value={range.label}>
                {range.label}
              </MenuItem>
            ))}
          </Select>
        </FormControl>
      </Box>
    </>
  );
};

const Products = () => {
  const location = useLocation();
  const params = new URLSearchParams(location.search);
  const category = parseInt(params.get("category"));
  const searchParam = params.get("search");

  const [price, setPrice] = useState([null, null]);
  const [loadingCategories, setLoadingCategories] = useState(false);
  const [categories, setCategories] = useState([]);
  const [search, setSearch] = useState(searchParam || "");
  const [checkedCategories, setCheckedCategories] = useState(
    category ? [category] : []
  );
  const [orderByPrice, setOrderByPrice] = useState("");
  const [orderByRating, setOrderByRating] = useState("");

  const [products, setProducts] = useState([]);
  const [count, setCount] = useState(0);
  const [page, setPage] = useState(0);
  const [rowsPerPage, setRowsPerPage] = useState(20);
  const [loading, setLoading] = useState(true);

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
    async (page = 0, limit = 20, search = "") => {
      setLoading(true);
      try {
        const response = await axiosDefault.get(Api.products(), {
          params: {
            limit: limit,
            page: page,
            order_by_price: orderByPrice,
            order_by_rating: orderByRating,
            categories: checkedCategories,
            min_price: price[0],
            max_price: price[1],
            search: search,
            status: "active",
          },
        });

        // Kiểm tra tổng số phần tử và cập nhật lại trang nếu cần thiết
        if (limit * (page + 1) > response.data.count) {
          setPage(Math.max(0, Math.floor(response.data.count / limit)));
        }

        setProducts(response.data.products);
        setCount(response.data.count);
      } catch (error) {
        Log.error(error.response?.data?.message);
      } finally {
        setLoading(false);
      }
    },
    [checkedCategories, orderByPrice, orderByRating, price]
  );

  useEffect(() => {
    fetchCategories();
  }, [fetchCategories]);

  useEffect(() => {
    // Gọi API khi tải lần đầu tiên
    fetchProducts(page, rowsPerPage, search);
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [fetchProducts, page, rowsPerPage]); // Khi page hoặc rowsPerPage thay đổi, gọi lại API

  // Xử lý khi thay đổi trang
  const handleChangePage = (event, newPage) => {
    setPage(newPage);
  };

  // Xử lý khi thay đổi số lượng sản phẩm mỗi trang
  const handleChangeRowsPerPage = (event) => {
    const newRowsPerPage = parseInt(event.target.value, 10);
    setRowsPerPage(newRowsPerPage);
    setPage(0); // Reset page về trang đầu tiên khi thay đổi số sản phẩm mỗi trang
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

  // Xử lý khi nhấn nút tìm kiếm
  const handleSearch = () => {
    fetchProducts(0, rowsPerPage, search); // Reset về trang đầu tiên khi tìm kiếm
    setPage(0);
  };

  return (
    <Container maxWidth="xl">
      <Grid2 container spacing={3} columns={10}>
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
                <Price price={price} setPrice={setPrice} />
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
          <PaperCustom sx={{ height: "100%", px: 3 }}>
            <Grid2
              container
              columnSpacing={3}
              rowSpacing={1.5}
              alignItems={"center"}
              sx={{ mt: 2, mb: 1 }}
            >
              <Grid2 size={6}>
                <TextField
                  variant="outlined"
                  autoComplete="off"
                  type="text"
                  label="Tìm kiếm"
                  placeholder="Quần, áo,..."
                  size="small"
                  fullWidth
                  value={search}
                  onChange={(e) => setSearch(e.target.value)}
                />
              </Grid2>
              <Grid2 size={6} height={40}>
                <ButtonLoading
                  variant={"contained"}
                  onClick={handleSearch}
                  sx={{ height: "100%" }}
                >
                  Tìm kiếm/Lọc
                </ButtonLoading>
              </Grid2>
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
                  <SkeletonProducts count={10} columns={10} />
                ) : products.length > 0 ? (
                  <ShowProducts products={products} columns={10} />
                ) : (
                  <NoContent text="Không tìm thấy sản phẩm nào" />
                )}
              </Grid2>
              {count > 0 && (
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
              )}
            </Grid2>
          </PaperCustom>
        </Grid2>
      </Grid2>
    </Container>
  );
};

export default Products;
