import { useTheme } from "@emotion/react";
import { TabContext, TabList } from "@mui/lab";
import {
  Avatar,
  Box,
  Button,
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

const ListUsers = ({ status, loading, setLoading }) => {
  const navigate = useNavigate();
  const theme = useTheme();

  const [users, setUsers] = useState([]);
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
        const response = await axiosWithAuth.get(Api.adminUsers(), {
          params: {
            limit: limit,
            page: page,
            status: status,
          },
          navigate,
        });

        setUsers(response.data.users);
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
              <TableCell align="left" width={300}>
                Người mua
              </TableCell>
              <TableCell align="center">Số điện thoại</TableCell>
              <TableCell align="center">Trạng thái</TableCell>
              <TableCell align="center">Ngày tham gia</TableCell>
              <TableCell align="center">Hành động</TableCell>
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
                {users && users.length > 0 ? (
                  users.map((users) => (
                    <TableRow hover key={users.user_id}>
                      <TableCell>
                        <Box
                          sx={{ display: "flex", alignItems: "center", gap: 2 }}
                        >
                          <Avatar
                            alt={users.name}
                            variant="square"
                            src={Path.publicAvatar(users?.avatar)}
                            sx={{ width: 50, height: 50 }}
                          >
                            {users.name.charAt(0).toUpperCase()}
                          </Avatar>
                          <Typography className="line-clamp-2" variant="body2">
                            {users.name}
                          </Typography>
                        </Box>
                      </TableCell>
                      <TableCell align="center">{users.phone}</TableCell>
                      <TableCell align="center">
                        {Format.formatStatus(users.status)}
                      </TableCell>
                      <TableCell align="center">
                        {Format.formatDate(users.created_at)}
                      </TableCell>
                      <TableCell align="center">
                        <Button variant="contained">Khóa</Button>
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

const Users = () => {
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
          <ListUsers
            status={pageName}
            loading={loading}
            setLoading={setLoading}
          />
        );
      case "active":
        return (
          <ListUsers
            status={pageName}
            loading={loading}
            setLoading={setLoading}
          />
        );
      case "locked":
        return (
          <ListUsers
            status={pageName}
            loading={loading}
            setLoading={setLoading}
          />
        );
      default:
        return (
          <ListUsers status="all" loading={loading} setLoading={setLoading} />
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
                <Tab disabled={loading} label="Tất cả người mua" value="all" />
                <Tab disabled={loading} label="Đang hoạt động" value="active" />
                <Tab disabled={loading} label="Đã khóa" value="locked" />
              </TabList>
            </Box>
          </TabContext>
        </Box>

        {renderComponent()}
      </PaperCustom>
    </>
  );
};

export default Users;
