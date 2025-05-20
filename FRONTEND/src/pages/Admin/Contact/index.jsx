import { useTheme } from "@emotion/react";
import { TabContext, TabList } from "@mui/lab";
import {
  Box,
  Button,
  Grid2,
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

const ResponseContact = ({ contact, setContacts }) => {
  const navigate = useNavigate();

  const { enqueueSnackbar } = useSnackbar();

  const [open, setOpen] = useState(false);
  const [loading, setLoading] = useState(false);
  const [content, setContent] = useState("");

  const fetchApi = async () => {
    setLoading(true);
    try {
      const response = await axiosWithAuth.post(
        Api.contact("reply"),
        {
          id: contact.id,
          content,
        },
        {
          navigate,
        }
      );
      setOpen(false);

      setContacts((prev) =>
        prev.map((item) =>
          item.id === contact.id ? { ...item, response: content } : item
        )
      );

      enqueueSnackbar(response.data.message, { variant: "success" });
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  };

  return (
    <>
      <Button variant="outlined" size="small" onClick={() => setOpen(true)}>
        Phản hồi
      </Button>

      <ModalCustom
        open={open}
        handleClose={() => setOpen(false)}
        title="Phản hồi"
        subtitle={"Phản hồi cho " + contact.name}
        sx={{ zIndex: 9999 }}
      >
        <Box py={1}>
          <TextField
            multiline
            rows={4}
            placeholder="Nhập nội dung phản hồi"
            fullWidth
            value={content}
            onChange={(e) => setContent(e.target.value)}
          />
        </Box>

        <Grid2 container spacing={2} alignItems={"center"} mt={2}>
          <Grid2 size={6}>
            <Button
              fullWidth
              variant="outlined"
              size="large"
              color="error"
              onClick={() => setOpen(false)}
            >
              Hủy
            </Button>
          </Grid2>

          <Grid2 size={6}>
            <ButtonLoading
              fullWidth
              variant="contained"
              size="large"
              color="primary"
              loading={loading}
              onClick={() => fetchApi()}
            >
              Gửi phản hồi
            </ButtonLoading>
          </Grid2>
        </Grid2>
      </ModalCustom>
    </>
  );
};

const Contact = () => {
  const params = useParams();
  const navigate = useNavigate();
  const pageName = params.pageName || "all";
  const theme = useTheme();

  const [loading, setLoading] = useState(false);
  const [contacts, setContacts] = useState([]);

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
        const response = await axiosWithAuth.get(Api.contact(), {
          params: {
            limit: limit,
            page: page,
            type: pageName,
            search: searchRef.current,
          },
          navigate,
        });

        setContacts(response.data.contacts);
        setCount(response.data.count);
      } catch (error) {
        Log.error(error);
      } finally {
        setLoading(false);
      }
    },
    [navigate, pageName]
  );

  useEffect(() => {
    fetchApi();
  }, [fetchApi]);

  const handleChange = (event, newValue) => {
    navigate(Path.adminContact(newValue));
  };

  return (
    <PaperCustom sx={{ px: 3 }}>
      <Box sx={{ width: "100%", typography: "body1" }}>
        <TabContext value={pageName}>
          <Box sx={{ borderBottom: 1, borderColor: "divider" }}>
            <TabList onChange={handleChange} aria-label="lab API tabs example">
              <Tab disabled={loading} label="Tất cả" value="all" />
              <Tab disabled={loading} label="Chưa phản hồi" value="unreplied" />
              <Tab disabled={loading} label="Đã phản hồi" value="replied" />
            </TabList>
          </Box>
        </TabContext>
      </Box>

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
          label="Tìm kiếm người liên hệ"
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
              <TableCell align="center">Họ tên</TableCell>
              <TableCell align="center">Số điện thoại</TableCell>
              <TableCell align="center">Vấn đề</TableCell>
              <TableCell align="center">Nội dung</TableCell>
              <TableCell align="center">Thời gian tạo</TableCell>
              <TableCell align="center" width={300}>
                Phản hồi
              </TableCell>
            </TableRow>
          </TableHead>

          <TableBody>
            {loading ? (
              <>
                <TableRow>
                  <TableCell>
                    <Skeleton height={40} width={"100%"} sx={{ px: 2 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton height={40} width={"100%"} sx={{ px: 2 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton height={40} width={"100%"} sx={{ px: 2 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton height={40} width={"100%"} sx={{ px: 2 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton height={40} width={"100%"} sx={{ px: 2 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton height={40} width={"100%"} sx={{ px: 2 }} />
                  </TableCell>
                </TableRow>

                <TableRow>
                  <TableCell>
                    <Skeleton height={40} width={"100%"} sx={{ px: 2 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton height={40} width={"100%"} sx={{ px: 2 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton height={40} width={"100%"} sx={{ px: 2 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton height={40} width={"100%"} sx={{ px: 2 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton height={40} width={"100%"} sx={{ px: 2 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton height={40} width={"100%"} sx={{ px: 2 }} />
                  </TableCell>
                </TableRow>

                <TableRow>
                  <TableCell>
                    <Skeleton height={40} width={"100%"} sx={{ px: 2 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton height={40} width={"100%"} sx={{ px: 2 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton height={40} width={"100%"} sx={{ px: 2 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton height={40} width={"100%"} sx={{ px: 2 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton height={40} width={"100%"} sx={{ px: 2 }} />
                  </TableCell>
                  <TableCell>
                    <Skeleton height={40} width={"100%"} sx={{ px: 2 }} />
                  </TableCell>
                </TableRow>
              </>
            ) : (
              <>
                {contacts && contacts.length > 0 ? (
                  contacts.map((contact) => (
                    <TableRow key={contact.id} sx={{ fontWeight: "regular" }}>
                      <TableCell align="center">{contact.name}</TableCell>
                      <TableCell align="center">{contact.phone}</TableCell>
                      <TableCell align="center">{contact.topic}</TableCell>
                      <TableCell align="center">{contact.content}</TableCell>
                      <TableCell align="center">
                        {Format.formatDateTime(contact.created_at)}
                      </TableCell>
                      <TableCell align="center">
                        {contact.response ? (
                          contact.response
                        ) : (
                          <ResponseContact
                            contact={contact}
                            setContacts={setContacts}
                          />
                        )}
                      </TableCell>
                    </TableRow>
                  ))
                ) : (
                  <TableRow>
                    <TableCell colSpan={7}>
                      <NoContent height={300} text="Không có liên hệ nào" />
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
    </PaperCustom>
  );
};

export default Contact;
