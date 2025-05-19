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
import { useSnackbar } from "notistack";
import { useCallback, useEffect, useState } from "react";
import { useNavigate, useParams } from "react-router-dom";
import ButtonLoading from "~/components/ButtonLoading";
import ModalCustom from "~/components/ModalCustom";
import NoContent from "~/components/NoContent";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import axiosWithAuth from "~/utils/axiosWithAuth";

const ActionLocked = ({ userId, name, status, updateStatus }) => {
  const navigate = useNavigate();
  const { enqueueSnackbar } = useSnackbar();

  const [open, setOpen] = useState(false);
  const [loading, setLoading] = useState(false);
  const [message, setMessage] = useState("");

  useEffect(() => {
    if (name) {
      if (status === "locked") {
        setMessage(
          "Tài khoản '" +
            name +
            "' đã được mở khóa. Vui lòng đăng nhập tại trang web " +
            import.meta.env.VITE_DOMAIN
        );
      } else {
        setMessage("Tài khoản '" + name + "' đã bị khóa. Lý do: ");
      }
    }
  }, [name, status]);

  const handleLocked = useCallback(async () => {
    setLoading(true);
    try {
      const response = await axiosWithAuth.put(
        Api.adminUsers("locked"),
        {
          user_id: userId,
          locked: status === "locked" ? 0 : 1,
          reason: message,
        },
        {
          navigate,
        }
      );

      enqueueSnackbar(response.data.message, {
        variant: "success",
      });
      updateStatus(userId, status === "locked" ? "active" : "locked");
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
      setOpen(false);
    }
  }, [navigate, enqueueSnackbar, userId, status, updateStatus, message]);

  return (
    <>
      <Button
        sx={{ ml: 1 }}
        variant="outlined"
        color={status === "locked" ? "primary" : "error"}
        size="small"
        onClick={() => setOpen(true)}
      >
        {status === "locked" ? "Mở khóa" : "Khóa tài khoản"}
      </Button>

      <ModalCustom
        open={open}
        handleClose={() => setOpen(false)}
        title={status === "locked" ? "Mở khóa tài khoản" : "Khóa tài khoản"}
        subtitle={name}
      >
        <TextField
          sx={{ width: "100%", mt: 1 }}
          fullWidth
          label={
            status === "locked"
              ? "Tin nhắn mở khóa tài khoản"
              : "Lý do khóa tài khoản"
          }
          multiline
          rows={3}
          variant="outlined"
          value={message}
          onChange={(e) => setMessage(e.target.value)}
        />

        <Box
          sx={{
            display: "flex",
            justifyContent: "center",
            gap: 2,
            mt: 3,
          }}
        >
          <Button
            size="large"
            variant="outlined"
            color="error"
            sx={{ width: "50%" }}
            onClick={() => setOpen(false)}
          >
            Hủy
          </Button>
          <ButtonLoading
            size="large"
            variant="contained"
            sx={{ width: "50%" }}
            onClick={() => {
              handleLocked();
            }}
            loading={loading}
          >
            {status === "locked" ? "Mở khóa" : "Khóa tài khoản"}
          </ButtonLoading>
        </Box>
      </ModalCustom>
    </>
  );
};

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

  const updateStatus = (userId, status) => {
    setUsers((prev) =>
      prev.map((item) =>
        item.user_id === userId ? { ...item, status: status } : item
      )
    );
  };

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
                  users.map((user) => (
                    <TableRow hover key={user.user_id}>
                      <TableCell>
                        <Box
                          sx={{ display: "flex", alignItems: "center", gap: 2 }}
                        >
                          <Avatar
                            alt={user.name}
                            variant="square"
                            src={Path.publicAvatar(user?.avatar)}
                            sx={{ width: 50, height: 50 }}
                          >
                            {user.name.charAt(0).toUpperCase()}
                          </Avatar>
                          <Typography className="line-clamp-2" variant="body2">
                            {user.name}
                          </Typography>
                        </Box>
                      </TableCell>
                      <TableCell align="center">{user.phone}</TableCell>
                      <TableCell align="center">
                        {Format.formatStatus(user.status)}
                      </TableCell>
                      <TableCell align="center">
                        {Format.formatDate(user.created_at)}
                      </TableCell>
                      <TableCell align="center">
                        <ActionLocked
                          status={user.status}
                          userId={user.user_id}
                          name={user.name}
                          updateStatus={updateStatus}
                        />
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
    navigate(Path.adminUsers(newValue));
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
