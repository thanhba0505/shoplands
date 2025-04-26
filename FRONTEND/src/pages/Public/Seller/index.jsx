import {
  Box,
  Container,
  Divider,
  Grid2,
  Skeleton,
  Typography,
} from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import { useNavigate, useParams } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Log from "~/helpers/Log";
import axiosDefault from "~/utils/axiosDefault";
import HideImageRoundedIcon from "@mui/icons-material/HideImageRounded";
import Path from "~/helpers/Path";
import TablePaginationCustom from "~/components/TablePaginationCustom";
import ShowProducts from "~/components/ShowProducts";
import SkeletonProducts from "~/components/SkeletonProducts";

const SellerInfo = () => {
  const navigate = useNavigate();
  const param = useParams();

  const sellerId = param.sellerId;

  const [seller, setSeller] = useState(null);
  const [loading, setLoading] = useState(true);

  const fetchSeller = useCallback(async () => {
    setLoading(true);
    try {
      const response = await axiosDefault.get(Api.sellers(sellerId));
      setSeller(response.data);
    } catch (error) {
      Log.error(error.response?.data?.message);
      navigate(Path.home());
    } finally {
      setLoading(false);
    }
  }, [sellerId, navigate]);

  // call api
  useEffect(() => {
    fetchSeller();
  }, [fetchSeller]);

  const background = seller?.background ?? null;
  const avatar = seller?.logo ?? null;
  const storeName = seller?.store_name ?? null;
  const ownerName = seller?.owner_name ?? null;
  const phone = seller?.phone ?? null;

  return (
    <PaperCustom sx={{ p: 0 }}>
      {loading ? (
        <Grid2 container sx={{ width: "100%", height: "400px", p: 8, gap: 6 }}>
          <Grid2 height={"100%"}>
            <Skeleton
              height={200}
              width={200}
              variant="rounded"
              sx={{ borderRadius: "20px" }}
            />
          </Grid2>
          <Grid2 height={"100%"} flexGrow={1}>
            <Skeleton variant="text" sx={{ fontSize: 32 }} width={"70%"} />
            <Skeleton
              variant="text"
              sx={{ fontSize: 16, mt: 1 }}
              width={"40%"}
            />
            <Skeleton
              variant="text"
              sx={{ fontSize: 16, mt: 1 }}
              width={"50%"}
            />
            <Skeleton
              variant="text"
              sx={{ fontSize: 16, mt: 1 }}
              width={"20%"}
            />
            <Skeleton
              variant="text"
              sx={{ fontSize: 16, mt: 1 }}
              width={"30%"}
            />
            <Skeleton
              variant="text"
              sx={{ fontSize: 16, mt: 1 }}
              width={"25%"}
            />
          </Grid2>
        </Grid2>
      ) : (
        <Box
          sx={{
            width: "100%",
            height: "400px",
            borderRadius: "4px",
            overflow: "hidden",
            backgroundImage: background
              ? `linear-gradient(to right, rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.6),rgba(0, 0, 0, 0.4),rgba(0, 0, 0, 0.2)), url(${Path.publicBackground(
                  background
                )})`
              : "none",
            backgroundColor: "rgba(0, 0, 0, 0.4)",
            backgroundSize: "cover",
            backgroundPosition: "center",
            position: "relative",
          }}
        >
          <Box
            sx={{
              position: "absolute",
              top: 0,
              left: 0,
              display: "flex",
              gap: 6,
              width: "100%",
              height: "100%",
              p: 8,
            }}
          >
            <Box
              sx={{
                width: "200px",
                height: "200px",
                minWidth: "200px",
                borderRadius: "20px",
                overflow: "hidden",
                backgroundImage: avatar
                  ? `url(${Path.publicAvatar(avatar)})`
                  : "none",
                backgroundColor: "#fff",
                backgroundSize: "cover",
                backgroundPosition: "center",
                display: "flex",
                justifyContent: "center",
                alignItems: "center",
                boxShadow: "0px 0px 8px #fff",
              }}
            >
              {!avatar && <HideImageRoundedIcon fontSize="medium" />}
            </Box>

            <Box sx={{ textAlign: "start", mt: "-4px", flexGrow: 1 }}>
              <Typography
                color="white"
                variant="body1"
                fontSize={32}
                fontWeight="bold"
                className="line-clamp-3"
              >
                {storeName}
              </Typography>
              <Typography
                color="white"
                variant="body2"
                fontSize={16}
                sx={{ mt: 0.5 }}
              >
                {ownerName}
              </Typography>
              <Typography
                color="white"
                variant="body2"
                fontSize={16}
                sx={{ mt: 0.5 }}
              >
                Số điện thoại: {phone}
              </Typography>
              <Divider sx={{ my: 2, backgroundColor: "#fff", width: "50%" }} />
              <Typography
                color="white"
                variant="body2"
                fontSize={16}
                sx={{ mt: 0.5 }}
              >
                Lượt đánh giá: {seller?.review_count ?? 0}
              </Typography>
              <Typography
                color="white"
                variant="body2"
                fontSize={16}
                sx={{ mt: 0.5 }}
              >
                Đánh giá trung bình: {seller?.average_rating ?? 0}
              </Typography>
              <Typography
                color="white"
                variant="body2"
                fontSize={16}
                sx={{ mt: 0.5 }}
              >
                Số sản phẩm: {seller?.product_count ?? 0}
              </Typography>
            </Box>
          </Box>
        </Box>
      )}
    </PaperCustom>
  );
};

const ProductsSeller = () => {
  const param = useParams();

  const sellerId = param.sellerId;
  const [productsSeller, setProductsSeller] = useState([]);

  const [loading, setLoading] = useState(true);

  const [count, setCount] = useState(0);
  const [page, setPage] = useState(0);
  const [rowsPerPage, setRowsPerPage] = useState(18);

  const fetchProducts = useCallback(
    async (page = 0, limit = 18) => {
      setLoading(true);
      try {
        const response = await axiosDefault.get(Api.products(), {
          params: {
            limit: limit,
            page: page,
            seller_id: sellerId,
          },
        });

        // Kiểm tra tổng số phần tử và cập nhật lại trang nếu cần thiết
        if (limit * (page + 1) > response.data.count) {
          setPage(Math.max(0, Math.floor(response.data.count / limit)));
        }

        setProductsSeller(response.data.products);
        setCount(response.data.count);
      } catch (error) {
        Log.error(error.response?.data?.message);
      } finally {
        setLoading(false);
      }
    },
    [setProductsSeller, setCount, setPage, sellerId]
  );

  useEffect(() => {
    // Gọi API khi tải lần đầu tiên
    fetchProducts(page, rowsPerPage);
  }, [fetchProducts, page, rowsPerPage]);

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

  return (
    <PaperCustom sx={{ px: 3 }}>
      <Box
        sx={{
          display: "flex",
          justifyContent: "space-between",
          alignItems: "center",
          mt: 0,
          mb: 2,
        }}
      >
        <Typography variant="h6" textAlign={"center"}>
          Sản phẩm của cửa hàng
        </Typography>
        <TablePaginationCustom
          loading={loading}
          count={count}
          page={page}
          rowsPerPage={rowsPerPage}
          handleChangePage={handleChangePage}
          handleChangeRowsPerPage={handleChangeRowsPerPage}
          labelRowsPerPage="Số sản phẩm mỗi trang"
          rowsPerPageOptions={[18, 36, 72]}
        />
      </Box>

      <Box mt={1}>
        {loading ? (
          <SkeletonProducts count={18} columns={12} size={2} />
        ) : (
          <ShowProducts products={productsSeller} columns={12} />
        )}
      </Box>

      <Box sx={{ mt: 2 }}>
        <TablePaginationCustom
          loading={loading}
          count={count}
          page={page}
          rowsPerPage={rowsPerPage}
          handleChangePage={handleChangePage}
          handleChangeRowsPerPage={handleChangeRowsPerPage}
          labelRowsPerPage="Số sản phẩm mỗi trang"
          rowsPerPageOptions={[18, 36, 72]}
        />
      </Box>
    </PaperCustom>
  );
};

const ProductsOther = () => {
  const [productsSeller, setProductsSeller] = useState([]);

  const [loading, setLoading] = useState(true);

  const [count, setCount] = useState(0);
  const [page, setPage] = useState(0);
  const [rowsPerPage, setRowsPerPage] = useState(18);

  const fetchProducts = useCallback(
    async (page = 0, limit = 18) => {
      setLoading(true);
      try {
        const response = await axiosDefault.get(Api.products(), {
          params: {
            limit: limit,
            page: page,
          },
        });

        // Kiểm tra tổng số phần tử và cập nhật lại trang nếu cần thiết
        if (limit * (page + 1) > response.data.count) {
          setPage(Math.max(0, Math.floor(response.data.count / limit)));
        }

        setProductsSeller(response.data.products);
        setCount(response.data.count);
      } catch (error) {
        Log.error(error.response?.data?.message);
      } finally {
        setLoading(false);
      }
    },
    [setProductsSeller, setCount, setPage]
  );

  useEffect(() => {
    // Gọi API khi tải lần đầu tiên
    fetchProducts(page, rowsPerPage);
  }, [fetchProducts, page, rowsPerPage]);

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

  return (
    <PaperCustom sx={{ px: 3 }}>
      <Box
        sx={{
          display: "flex",
          justifyContent: "space-between",
          alignItems: "center",
          mt: 0,
          mb: 2,
        }}
      >
        <Typography variant="h6" textAlign={"center"}>
          Gợi ý cho bạn
        </Typography>
        <TablePaginationCustom
          loading={loading}
          count={count}
          page={page}
          rowsPerPage={rowsPerPage}
          handleChangePage={handleChangePage}
          handleChangeRowsPerPage={handleChangeRowsPerPage}
          labelRowsPerPage="Số sản phẩm mỗi trang"
          rowsPerPageOptions={[18, 36, 72]}
        />
      </Box>

      <Box mt={1}>
        {loading ? (
          <SkeletonProducts count={18} columns={12} size={2} />
        ) : (
          <ShowProducts products={productsSeller} columns={12} />
        )}
      </Box>

      <Box sx={{ mt: 2 }}>
        <TablePaginationCustom
          loading={loading}
          count={count}
          page={page}
          rowsPerPage={rowsPerPage}
          handleChangePage={handleChangePage}
          handleChangeRowsPerPage={handleChangeRowsPerPage}
          labelRowsPerPage="Số sản phẩm mỗi trang"
          rowsPerPageOptions={[18, 36, 72]}
        />
      </Box>
    </PaperCustom>
  );
};

const Seller = () => {
  return (
    <>
      <Container maxWidth="xl">
        <SellerInfo />
      </Container>

      <Container maxWidth="xl">
        <ProductsSeller />
      </Container>

      <Container maxWidth="xl">
        <ProductsOther />
      </Container>
    </>
  );
};

export default Seller;
