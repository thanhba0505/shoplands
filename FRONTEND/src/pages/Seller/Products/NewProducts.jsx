import React, { useState } from "react";
import axiosWithAuth from "~/utils/axiosWithAuth";
import Api from "~/helpers/Api";
import Log from "~/helpers/Log";
import {
  Button,
  TextField,
  Box,
  Typography,
  Grid2,
  TableContainer,
  Table,
  TableHead,
  TableRow,
  TableCell,
  TableBody,
  Avatar,
  styled,
  Autocomplete,
} from "@mui/material";
import CloudUploadIcon from "@mui/icons-material/CloudUpload";

const VisuallyHiddenInput = styled("input")({
  clip: "rect(0 0 0 0)",
  clipPath: "inset(50%)",
  height: 1,
  overflow: "hidden",
  position: "absolute",
  bottom: 0,
  left: 0,
  whiteSpace: "nowrap",
  width: 1,
});

const NewProducts = () => {
  const [name, setName] = useState("");
  const [images, setImages] = useState([]);
  const [description, setDescription] = useState("");
  const [categoryId, setCategoryId] = useState(null);
  const [productDetails, setProductDetails] = useState([]);
  const [productVariants, setProductVariants] = useState([]);

  const [countDetails, setCountDetails] = useState(0);
  const [countAttributes, setCountAttributes] = useState(0);

  const options = [
    { label: "The Godfather", id: 1 },
    { label: "Pulp Fiction", id: 2 },
  ];
  return (
    <Grid2 container spacing={2} sx={{ width: "100%", padding: 2 }}>
      <Grid2 size={8}>
        <TableContainer>
          <Table
          // sx={{ "& td, & th": { border: "none" }, verticalAlign: "center" }}
          >
            <TableBody>
              {/* Tên sản phẩm */}
              <TableRow>
                <TableCell width={"24%"}>Tên sản phẩm: </TableCell>
                <TableCell>
                  <TextField
                    variant="outlined"
                    autoComplete="off"
                    type="text"
                    label="Tên sản phẩm"
                    size="small"
                    fullWidth
                    value={name}
                    onChange={(e) => setName(e.target.value)}
                  />
                </TableCell>
              </TableRow>

              {/* Mô tả */}
              <TableRow>
                <TableCell>Mô tả: </TableCell>
                <TableCell>
                  <TextField
                    variant="outlined"
                    multiline
                    rows={4}
                    autoComplete="off"
                    type="text"
                    label="Mô tả"
                    size="small"
                    fullWidth
                    value={name}
                    onChange={(e) => setName(e.target.value)}
                  />
                </TableCell>
              </TableRow>

              {/* Danh mục */}
              <TableRow>
                <TableCell>Danh mục: </TableCell>
                <TableCell>
                  <Autocomplete
                    disablePortal
                    options={options}
                    size="small"
                    sx={{ width: 300 }}
                    renderInput={(params) => (
                      <TextField {...params} label="Danh mục" />
                    )}
                  />
                </TableCell>
              </TableRow>

              {/* Chi tiết sản phẩm */}
              <TableRow>
                <TableCell>Chi tiết sản phẩm: </TableCell>
                <TableCell>
                  <Grid2 container spacing={2}>
                    <Grid2 size={12}>
                      Thông tin chi tiết sản phẩm, ví dụ: Nơi sản xuất: Việt Nam
                    </Grid2>
                    {Array.from({ length: countDetails }).map((_, index) => (
                      <React.Fragment key={index}>
                        <Grid2 size={4}>
                          <TextField
                            variant="outlined"
                            autoComplete="off"
                            type="text"
                            label="Từ khóa"
                            placeholder="Nơi sản xuất"
                            size="small"
                            fullWidth
                            value={name}
                            onChange={(e) => setName(e.target.value)}
                          />
                        </Grid2>
                        <Grid2 size={8}>
                          <TextField
                            variant="outlined"
                            autoComplete="off"
                            type="text"
                            label="Nội dung"
                            size="small"
                            placeholder="Việt Nam"
                            fullWidth
                            value={name}
                            onChange={(e) => setName(e.target.value)}
                          />
                        </Grid2>
                      </React.Fragment>
                    ))}

                    <Grid2>
                      <Button
                        fullWidth
                        variant="outlined"
                        color="error"
                        size="small"
                        onClick={() => setCountDetails(0)}
                      >
                        Xóa tất cả
                      </Button>
                    </Grid2>

                    <Grid2 >
                      <Button
                        fullWidth
                        color="info"
                        variant="outlined"
                        size="small"
                        disabled={countDetails >= 10}
                        onClick={() =>
                          setCountDetails(
                            countDetails >= 10 ? countDetails : countDetails + 1
                          )
                        }
                      >
                        {countDetails >= 10
                          ? "Đã đạt giới hạn"
                          : "Thêm 1 dòng chi tiết"}
                      </Button>
                    </Grid2>
                  </Grid2>
                </TableCell>
              </TableRow>

              {/* Thuộc tính  */}
              <TableRow>
                <TableCell>Thuộc tính: </TableCell>
                <TableCell>
                  <Grid2 container spacing={2}>
                    <Grid2 size={12}>
                      Các thuộc tính sản phẩm, ví dụ: (Màu: Xanh, Đỏ), (Size: S,
                      M, L)
                    </Grid2>
                    {Array.from({ length: countAttributes }).map((_, index) => (
                      <React.Fragment key={index}>
                        <Grid2 size={4}>
                          <TextField
                            variant="outlined"
                            autoComplete="off"
                            type="text"
                            label="Thuộc tính"
                            placeholder="Màu"
                            size="small"
                            fullWidth
                            value={name}
                            onChange={(e) => setName(e.target.value)}
                          />
                        </Grid2>
                        <Grid2 container spacing={1} size={8}>
                          <TextField
                            variant="outlined"
                            autoComplete="off"
                            type="text"
                            label="Giá trị thuộc tính"
                            placeholder="Xanh, Đỏ"
                            size="small"
                            fullWidth
                            value={name}
                            onChange={(e) => setName(e.target.value)}
                          />
                        </Grid2>
                      </React.Fragment>
                    ))}

                    <Grid2>
                      <Button
                        fullWidth
                        variant="outlined"
                        color="error"
                        size="small"
                        onClick={() => setCountAttributes(0)}
                      >
                        Xóa tất cả
                      </Button>
                    </Grid2>

                    <Grid2>
                      <Button
                        fullWidth
                        color="info"
                        variant="outlined"
                        size="small"
                        disabled={countAttributes >= 3}
                        onClick={() =>
                          setCountAttributes(
                            countAttributes >= 3
                              ? countAttributes
                              : countAttributes + 1
                          )
                        }
                      >
                        {countAttributes >= 3
                          ? "Đã đạt giới hạn"
                          : "Thêm 1 dòng thuộc tính"}
                      </Button>
                    </Grid2>
                  </Grid2>
                </TableCell>
              </TableRow>

              {/* Giá và tồn kho */}
              <TableRow>
                <TableCell width={"24%"}>Giá và tồn kho: </TableCell>
                <TableCell>
                  <Grid2 container spacing={2}>
                    {countAttributes == 0 ? (
                      <>
                        <Grid2 size={12}>
                          Giá của sản phẩm, khuyến mãi (nếu có) và tồn kho
                        </Grid2>
                        <Grid2 size={4}>
                          <TextField
                            variant="outlined"
                            autoComplete="off"
                            type="text"
                            label="Giá gốc"
                            placeholder="100.000đ"
                            size="small"
                            fullWidth
                            value={name}
                            onChange={(e) => setName(e.target.value)}
                          />
                        </Grid2>
                        <Grid2 size={4}>
                          <TextField
                            variant="outlined"
                            autoComplete="off"
                            type="text"
                            label="Giá khuyến mãi"
                            placeholder="80.000đ"
                            size="small"
                            fullWidth
                            value={name}
                            onChange={(e) => setName(e.target.value)}
                          />
                        </Grid2>
                        <Grid2 size={4}>
                          <TextField
                            variant="outlined"
                            autoComplete="off"
                            type="text"
                            label="Tồn kho"
                            placeholder="999"
                            size="small"
                            fullWidth
                            value={name}
                            onChange={(e) => setName(e.target.value)}
                          />
                        </Grid2>
                      </>
                    ) : (
                      <></>
                    )}
                  </Grid2>
                </TableCell>
              </TableRow>

              {/* Button */}
              <TableRow>
                <TableCell colSpan={2}>
                  <Grid2 container spacing={2}>
                    <Grid2 size={6}>
                      <Button
                        fullWidth
                        variant="outlined"
                        color="error"
                        size="small"
                      >
                        Huy
                      </Button>
                    </Grid2>
                    <Grid2 size={6}>
                      <Button
                        fullWidth
                        color="info"
                        variant="contained"
                        size="small"
                      >
                        Tạo mô tảng
                      </Button>
                    </Grid2>
                  </Grid2>
                </TableCell>
              </TableRow>
            </TableBody>
          </Table>
        </TableContainer>
      </Grid2>

      <Grid2 size={4}>
        <Grid2 container spacing={2} justifyContent={"center"}>
          <Grid2 size={12}>
            <Avatar
              sx={{ width: "120px", height: "120px", m: "auto" }}
              variant="rounded"
            >
              Mặc định
            </Avatar>
          </Grid2>

          <Grid2 size={4}>
            <Avatar
              sx={{ width: "100px", height: "100px", m: "auto" }}
              variant="rounded"
            >
              Mặc định
            </Avatar>
          </Grid2>
          <Grid2 size={4}>
            <Avatar
              sx={{ width: "100px", height: "100px", m: "auto" }}
              variant="rounded"
            >
              Mặc định
            </Avatar>
          </Grid2>
          <Grid2 size={4}>
            <Avatar
              sx={{ width: "100px", height: "100px", m: "auto" }}
              variant="rounded"
            >
              Mặc định
            </Avatar>
          </Grid2>
          <Grid2 size={4}>
            <Avatar
              sx={{ width: "100px", height: "100px", m: "auto" }}
              variant="rounded"
            >
              Mặc định
            </Avatar>
          </Grid2>
          <Grid2 size={4}>
            <Avatar
              sx={{ width: "100px", height: "100px", m: "auto" }}
              variant="rounded"
            >
              Mặc định
            </Avatar>
          </Grid2>
          <Grid2 size={4}>
            <Avatar
              sx={{ width: "100px", height: "100px", m: "auto" }}
              variant="rounded"
            >
              Mặc định
            </Avatar>
          </Grid2>

          <Grid2 size={"auto"}>
            <Button
              sx={{ m: "auto", marginTop: 2 }}
              component="label"
              role={undefined}
              variant="outlined"
              tabIndex={-1}
              startIcon={<CloudUploadIcon />}
            >
              Upload files
              <VisuallyHiddenInput
                type="file"
                onChange={(event) => console.log(event.target.files)}
                multiple
              />
            </Button>
          </Grid2>
        </Grid2>
      </Grid2>
    </Grid2>
  );
};

export default NewProducts;
