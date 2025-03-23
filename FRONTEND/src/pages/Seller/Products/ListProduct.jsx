import { Box, TablePagination, TextField } from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import { useSelector } from "react-redux";
import { useNavigate } from "react-router-dom";
import CircularProgressLoading from "~/components/CircularProgressLoading";
import Api from "~/helpers/Api";
import Log from "~/helpers/Log";
import axiosWithAuth from "~/utils/axiosWithAuth";

const ListProduct = ({ status, loading, setLoading }) => {
  const seller_id = useSelector((state) => state.auth?.account?.seller_id);
  const navigate = useNavigate();

  const [products, setProducts] = useState([]);
  const [count, setCount] = useState(0);
  const [page, setPage] = useState(0);
  const [rowsPerPage, setRowsPerPage] = useState(10);

  const handleChangePage = (event, newPage) => {
    setPage(newPage);
    fetchApi(newPage, rowsPerPage);
  };

  const handleChangeRowsPerPage = (event) => {
    const newRowsPerPage = parseInt(event.target.value, 10);
    setRowsPerPage(newRowsPerPage);
    setPage(0);
    fetchApi(0, newRowsPerPage);
  };

  const fetchApi = useCallback(
    async (page = 0, limit = 10) => {
      setLoading(true);
      try {
        if (seller_id) {
          const response = await axiosWithAuth.get(Api.sellerProducts(), {
            params: {
              limit: limit,
              page: page + 1,
              status: status,
            },
            navigate,
          });

          setProducts(response.data.products);
          setCount(response.data.count);
        }
      } catch (error) {
        Log.error(error.response?.data?.message);
      } finally {
        setLoading(false);
      }
    },
    [seller_id, status, setLoading, navigate]
  );

  useEffect(() => {
    fetchApi(page, rowsPerPage);
  }, [seller_id, page, rowsPerPage, status, fetchApi]);

  return (
    <>
      <Box
        sx={{
          display: "flex",
          justifyContent: "space-between",
          gap: 2,
          alignItems: "center",
          py: 2,
        }}
      >
        <TextField
          size="small"
          label="Tìm kiếm sản phẩm"
          autoComplete="off"
          variant="outlined"
          sx={{ width: 500 }}
        />

        <TablePagination
          disabled={loading}
          component="div"
          count={count}
          page={page}
          onPageChange={handleChangePage}
          rowsPerPage={rowsPerPage}
          onRowsPerPageChange={handleChangeRowsPerPage}
          labelRowsPerPage="Số dòng mỗi trang"
          labelDisplayedRows={({ from, to, count }) =>
            `${from}-${to} trên ${count}`
          }
        />
      </Box>

      <div>
        {loading ? (
          <CircularProgressLoading sx={{ height: 300 }} />
        ) : (
          <div>
            {products &&
              products.length > 0 &&
              products.map((product) => (
                <div key={product.product_id}>{product.name}</div>
              ))}
          </div>
        )}
      </div>

      <TablePagination
        disabled={loading}
        component="div"
        count={count}
        page={page}
        onPageChange={handleChangePage}
        rowsPerPage={rowsPerPage}
        onRowsPerPageChange={handleChangeRowsPerPage}
        labelRowsPerPage="Số dòng mỗi trang"
        labelDisplayedRows={({ from, to, count }) =>
          `${from}-${to} trên ${count}`
        }
      />
    </>
  );
};

export default ListProduct;
