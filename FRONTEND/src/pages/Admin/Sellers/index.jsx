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
import { useCallback, useEffect, useRef, useState } from "react";
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

const ActionInactive = ({
  sellerId,
  removeSeller,
  updateStatus,
  store_name,
}) => {
  const navigate = useNavigate();
  const { enqueueSnackbar } = useSnackbar();

  const [open, setOpen] = useState(false);
  const [loading, setLoading] = useState(false);
  const [actionType, setActionType] = useState("");
  const [message, setMessage] = useState("");

  useEffect(() => {
    if (store_name && actionType) {
      if (actionType === "accept") {
        setMessage(
          "Cửa hàng '" +
            store_name +
            "' đã được duyệt. Vui lòng đăng nhập tại trang web " +
            import.meta.env.VITE_DOMAIN
        );
      } else {
        setMessage("Cửa hàng '" + store_name + "' đã bị từ chối. Lý do: ");
      }
    }
  }, [store_name, actionType]);

  const handleAction = useCallback(
    async (acceptValue) => {
      setLoading(true);
      try {
        const response = await axiosWithAuth.put(
          Api.adminSellers("register"),
          {
            seller_id: sellerId,
            accept: acceptValue === "accept" ? 1 : 0,
            reason: message,
          },
          { navigate }
        );

        enqueueSnackbar(response.data.message, { variant: "success" });

        if (acceptValue === "accept") {
          updateStatus(sellerId, "active");
        } else {
          removeSeller(sellerId);
        }
      } catch (error) {
        Log.error(error.response?.data?.message);
      } finally {
        setLoading(false);
        setOpen(false);
      }
    },
    [navigate, enqueueSnackbar, sellerId, updateStatus, removeSeller, message]
  );

  const openModal = (action) => {
    setActionType(action);
    setOpen(true);
  };

  return (
    <>
      {/* Nút Từ chối */}
      <Button
        variant="outlined"
        size="small"
        color="error"
        onClick={() => openModal("reject")}
      >
        Từ chối
      </Button>

      {/* Nút Duyệt */}
      <Button
        sx={{ ml: 1 }}
        variant="contained"
        color="primary"
        size="small"
        onClick={() => openModal("accept")}
      >
        Duyệt
      </Button>

      <ModalCustom
        open={open}
        handleClose={() => setOpen(false)}
        title={actionType === "accept" ? "Xác nhận duyệt" : "Xác nhận từ chối"}
        subtitle={store_name}
      >
        <TextField
          sx={{ width: "100%", mt: 1 }}
          fullWidth
          label={
            actionType === "accept"
              ? "Tin nhắn duyệt tài khoản"
              : "Lý do từ chối"
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
              handleAction(actionType);
            }}
            loading={loading}
          >
            {actionType === "accept" ? "Duyệt" : "Từ chối"}
          </ButtonLoading>
        </Box>
      </ModalCustom>
    </>
  );
};

const ActionLocked = ({ sellerId, store_name, status, updateStatus }) => {
  const navigate = useNavigate();
  const { enqueueSnackbar } = useSnackbar();

  const [open, setOpen] = useState(false);
  const [loading, setLoading] = useState(false);
  const [message, setMessage] = useState("");

  useEffect(() => {
    if (store_name) {
      if (status === "locked") {
        setMessage(
          "Cửa hàng '" +
            store_name +
            "' đã được mở khóa. Vui lòng đăng nhập tại trang web " +
            import.meta.env.VITE_DOMAIN
        );
      } else {
        setMessage("Cửa hàng '" + store_name + "' đã bị khóa. Lý do: ");
      }
    }
  }, [store_name, status]);

  const handleLocked = useCallback(async () => {
    setLoading(true);
    try {
      const response = await axiosWithAuth.put(
        Api.adminSellers("locked"),
        {
          seller_id: sellerId,
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
      updateStatus(sellerId, status === "locked" ? "active" : "locked");
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
      setOpen(false);
    }
  }, [navigate, enqueueSnackbar, sellerId, status, updateStatus, message]);

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
        subtitle={store_name}
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

const Action = ({
  status,
  sellerId,
  removeSeller,
  updateStatus,
  store_name,
}) => {
  if (status === "inactive") {
    return (
      <ActionInactive
        sellerId={sellerId}
        removeSeller={removeSeller}
        updateStatus={updateStatus}
        store_name={store_name}
      />
    );
  } else if (status === "locked" || status === "active") {
    return (
      <ActionLocked
        sellerId={sellerId}
        status={status}
        updateStatus={updateStatus}
        store_name={store_name}
      />
    );
  }
};

const ListSellers = ({ status, loading, setLoading }) => {
  const navigate = useNavigate();
  const theme = useTheme();

  const [sellers, setSellers] = useState([]);
  const [count, setCount] = useState(0);
  const [page, setPage] = useState(0);
  const [rowsPerPage, setRowsPerPage] = useState(10);

  const searchRef = useRef("");
  const [search, setSearch] = useState("");

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
            search: searchRef.current,
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

  const removeSeller = (sellerId) => {
    setSellers((prev) => prev.filter((item) => item.seller_id !== sellerId));
  };

  const updateStatus = (sellerId, status) => {
    setSellers((prev) =>
      prev.map((item) =>
        item.seller_id === sellerId ? { ...item, status: status } : item
      )
    );
  };

  return (
    <>
      <Box
        sx={{
          display: "flex",
          justifyContent: "start",
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
          value={search}
          onChange={(e) => {
            setSearch(e.target.value);
            searchRef.current = e.target.value;
          }}
          onKeyDown={(e) => e.key === "Enter" && fetchApi(page, rowsPerPage)}
          sx={{ width: 500 }}
        />

        <Box sx={{ mr: "auto" }}>
          <Button
            variant="contained"
            onClick={async () => await fetchApi(page, rowsPerPage)}
          >
            Tìm kiếm
          </Button>
        </Box>

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
              <TableCell align="center" width={250}>
                Người bán
              </TableCell>
              <TableCell align="center" width={300}>
                Mô tả
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
                {sellers && sellers.length > 0 ? (
                  sellers.map((seller) => (
                    <TableRow hover key={seller.seller_id}>
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
                      <TableCell align="center">
                        <Action
                          sellerId={seller.seller_id}
                          removeSeller={removeSeller}
                          updateStatus={updateStatus}
                          status={seller.status}
                          store_name={seller.store_name}
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

const Seller = () => {
  const params = useParams();
  const navigate = useNavigate();
  const pageName = params.pageName || "all";
  const [loading, setLoading] = useState(false);

  const handleChange = (event, newValue) => {
    navigate(Path.adminSellers(newValue));
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
                  value="inactive"
                />
              </TabList>
            </Box>
          </TabContext>
        </Box>

        <ListSellers
          status={pageName}
          loading={loading}
          setLoading={setLoading}
        />
      </PaperCustom>
    </>
  );
};

export default Seller;
