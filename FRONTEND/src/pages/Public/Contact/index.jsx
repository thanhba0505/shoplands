import { useTheme } from "@emotion/react";
import {
  Box,
  Container,
  FormControl,
  MenuItem,
  Select,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableRow,
  TextField,
  Typography,
} from "@mui/material";
import { useSnackbar } from "notistack";
import { useState } from "react";
import ButtonLoading from "~/components/ButtonLoading";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Log from "~/helpers/Log";
import axiosDefault from "~/utils/axiosDefault";

const Contact = () => {
  const theme = useTheme();
  const { enqueueSnackbar } = useSnackbar();

  const [topic, setTopic] = useState("Hỗ trợ kỹ thuật");
  const [content, setContent] = useState("");
  const [loading, setLoading] = useState(false);
  const [name, setName] = useState("");
  const [phone, setPhone] = useState("");

  const handleSubmit = async () => {
    setLoading(true);
    try {
      const response = await axiosDefault.post(Api.contact(), {
        name: name,
        phone: phone,
        topic: topic,
        content: content,
      });

      setName("");
      setPhone("");
      setContent("");
      setTopic("Hỗ trợ kỹ thuật");
      enqueueSnackbar(response.data.message, { variant: "success" });
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  };

  return (
    <Box
      sx={{
        minHeight: `calc(100vh - ${theme.custom.headerHeight} - 2 * ${theme.custom.containerGap})`,
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
        borderRadius: "12px",
      }}
    >
      <Container maxWidth="md">
        <PaperCustom sx={{ px: 3 }}>
          <Typography variant="h6" sx={{ mt: 2, mb: 3 }} textAlign={"center"}>
            Liên hệ với chúng tôi
          </Typography>

          <TableContainer sx={{ width: "800px", mx: "auto" }}>
            <Table>
              <TableBody>
                <TableRow>
                  <TableCell sx={{ border: "none", width: "150px" }}>
                    <Typography variant="body1">Họ tên đầy đủ:</Typography>
                  </TableCell>
                  <TableCell sx={{ border: "none" }}>
                    <TextField
                      variant="outlined"
                      autoComplete="off"
                      size="small"
                      fullWidth
                      placeholder="Nguyễn Văn A"
                      value={name}
                      onChange={(e) => setName(e.target.value)}
                    />
                  </TableCell>
                </TableRow>

                <TableRow>
                  <TableCell sx={{ border: "none" }}>
                    <Typography variant="body1">Số điện thoại:</Typography>
                  </TableCell>
                  <TableCell sx={{ border: "none" }}>
                    <TextField
                      variant="outlined"
                      autoComplete="off"
                      size="small"
                      type="number"
                      fullWidth
                      placeholder="0123456789"
                      value={phone}
                      onChange={(e) => setPhone(e.target.value)}
                    />
                  </TableCell>
                </TableRow>

                <TableRow>
                  <TableCell sx={{ border: "none" }}>
                    <Typography variant="body1">Vấn đề liên hệ:</Typography>
                  </TableCell>
                  <TableCell sx={{ border: "none" }}>
                    <FormControl fullWidth>
                      <Select
                        labelId="contact-topic"
                        id="demo-simple-select"
                        value={topic}
                        size="small"
                        displayEmpty
                        onChange={(e) => setTopic(e.target.value)}
                      >
                        <MenuItem value={"Hỗ trợ kỹ thuật"}>
                          -- Hỗ trợ kỹ thuật --
                        </MenuItem>
                        <MenuItem value={"Góp ý phát triển"}>
                          -- Góp ý phát triển --
                        </MenuItem>
                        <MenuItem value={"Báo lỗi"}>-- Báo lỗi --</MenuItem>
                        <MenuItem value={"Khóa/Mở khóa tài khoản"}>
                          -- Khóa/Mở khóa tài khoản --
                        </MenuItem>
                        <MenuItem value={"Khác"}>-- Khác --</MenuItem>
                      </Select>
                    </FormControl>
                  </TableCell>
                </TableRow>

                <TableRow>
                  <TableCell sx={{ border: "none" }}>
                    <Typography variant="body1">Nội dung:</Typography>
                  </TableCell>
                  <TableCell sx={{ border: "none" }}>
                    <TextField
                      variant="outlined"
                      autoComplete="off"
                      size="small"
                      multiline
                      rows={4}
                      fullWidth
                      placeholder="Hãy miêu tả vấn đề của bạn với chúng tôi"
                      value={content}
                      onChange={(e) => setContent(e.target.value)}
                    />
                  </TableCell>
                </TableRow>

                <TableRow>
                  <TableCell sx={{ border: "none" }} colSpan={2}>
                    <ButtonLoading
                      variant="contained"
                      color="primary"
                      sx={{ width: "100%" }}
                      onClick={handleSubmit}
                      loading={loading}
                      disabled={!name || !phone || !content || !topic}
                    >
                      Gửi
                    </ButtonLoading>
                  </TableCell>
                </TableRow>
              </TableBody>
            </Table>
          </TableContainer>
        </PaperCustom>
      </Container>
    </Box>
  );
};

export default Contact;
