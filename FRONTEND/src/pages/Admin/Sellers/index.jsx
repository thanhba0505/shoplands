import { useTheme } from "@emotion/react";
import { TabContext, TabList } from "@mui/lab";
import {
  Avatar,
  Box,
  Skeleton,
  Tab,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TablePagination,
  TableRow,
  TextField,
  Typography,
} from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import { useNavigate, useParams } from "react-router-dom";
import NoContent from "~/components/NoContent";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import axiosWithAuth from "~/utils/axiosWithAuth";

const ListSellers = ({ status, loading, setLoading }) => {
  const navigate = useNavigate();
  const theme = useTheme();

  const [sellers, setSellers] = useState([]);
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
        const response = await axiosWithAuth.get(Api.adminSellers(), {
          params: {
            limit: limit,
            page: page,
            status: status,
          },
          navigate,
        });

        setSellers(response.data.sellers);
        setCount(response.data.count);
      } catch (error) {
        Log.error(error.response?.data?.message);
      } finally {
        setLoading(false);
      }
    },
    [status, navigate, setLoading]
  );

  useEffect(() => {
    fetchApi(page, rowsPerPage);
  }, [page, rowsPerPage, fetchApi]);

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
          label="Tìm kiếm người bán"
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

      <TableContainer sx={{ borderRadius: 1 }}>
        <Table>
          <TableHead>
            <TableRow sx={{ backgroundColor: theme.custom?.primary.light }}>
              <TableCell align="center" width={300}>
                Người bán
              </TableCell>
              <TableCell align="center" width={300}>
                Mô tả
              </TableCell>
              <TableCell align="center" width={200}>
                Số điện thoại
              </TableCell>
              <TableCell align="center">Trạng thái</TableCell>
              <TableCell align="center">Ngày tham gia</TableCell>
            </TableRow>
          </TableHead>
          <TableBody>
            {loading ? (
              <>
                <TableRow>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                </TableRow>

                <TableRow>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                </TableRow>

                <TableRow>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                  <TableCell>
                    <Skeleton
                      height={40}
                      width={"100%"}
                      sx={{ mb: 1.5, my: 1, px: 2 }}
                    />
                  </TableCell>
                </TableRow>
              </>
            ) : (
              <>
                {sellers && sellers.length > 0 ? (
                  sellers.map((seller) => (
                    <TableRow
                      hover
                      sx={{ cursor: "pointer" }}
                      key={seller.seller_id}
                      // onClick={() =>
                      //   navigate(Path.sellerProductDetail(product.product_id))
                      // }
                    >
                      <TableCell>
                        <Box
                          sx={{ display: "flex", alignItems: "center", gap: 2 }}
                        >
                          <Avatar
                            alt={seller.store_name}
                            variant="square"
                            src={Path.publicAvatar(seller?.logo)}
                            sx={{ width: 50, height: 50 }}
                          >
                            {" "}
                            {}
                          </Avatar>
                          <Typography className="line-clamp-2" variant="body2">
                            {seller.store_name}
                          </Typography>
                        </Box>
                      </TableCell>
                      <TableCell align="center">
                        <Typography className="line-clamp-3" variant="body2">
                          {seller.description}
                        </Typography>
                      </TableCell>
                      <TableCell align="center">{seller.phone}</TableCell>
                      <TableCell align="center">
                        {Format.formatStatus(seller.status)}
                      </TableCell>
                      <TableCell align="center">
                        {Format.formatDate(seller.created_at)}
                      </TableCell>
                    </TableRow>
                  ))
                ) : (
                  <TableRow>
                    <TableCell colSpan={7}>
                      <NoContent height={300} text="Không có người bán nào" />
                    </TableCell>
                  </TableRow>
                )}
              </>
            )}
          </TableBody>
        </Table>
      </TableContainer>

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

const Seller = () => {
  const params = useParams();
  const navigate = useNavigate();
  const pageName = params.pageName || "all";
  const [loading, setLoading] = useState(false);

  const handleChange = (event, newValue) => {
    navigate(Path.adminSellers(newValue));
  };

  const renderComponent = () => {
    switch (pageName) {
      case "all":
        return (
          <ListSellers
            status={pageName}
            loading={loading}
            setLoading={setLoading}
          />
        );
      case "active":
        return (
          <ListSellers
            status={pageName}
            loading={loading}
            setLoading={setLoading}
          />
        );
      case "locked":
        return (
          <ListSellers
            status={pageName}
            loading={loading}
            setLoading={setLoading}
          />
        );
      case "unactive":
        return <>Sfasdf</>;
      default:
        return (
          <ListSellers status="all" loading={loading} setLoading={setLoading} />
        );
    }
  };

  return (
    <>
      <PaperCustom sx={{ px: 3 }}>
        <Box sx={{ width: "100%", typography: "body1" }}>
          <TabContext value={pageName}>
            <Box sx={{ borderBottom: 1, borderColor: "divider" }}>
              <TabList
                onChange={handleChange}
                aria-label="lab API tabs example"
              >
                <Tab disabled={loading} label="Tất cả người bán" value="all" />
                <Tab disabled={loading} label="Đang hoạt động" value="active" />
                <Tab disabled={loading} label="Đã khóa" value="locked" />
                <Tab
                  disabled={loading}
                  label="Chờ duyệt người bán"
                  value="unactive"
                />
              </TabList>
            </Box>
          </TabContext>
        </Box>

        {renderComponent()}
      </PaperCustom>
    </>
  );
};

export default Seller;
