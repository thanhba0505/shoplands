import { useTheme } from "@emotion/react";
import {
  Autocomplete,
  Avatar,
  Box,
  Button,
  Container,
  Grid2,
  TextField,
  Typography,
} from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import ButtonLoading from "~/components/ButtonLoading";
import PaperCustom from "~/components/PaperCustom";
import Path from "~/helpers/Path";
import HideImageRoundedIcon from "@mui/icons-material/HideImageRounded";
import Log from "~/helpers/Log";
import Api from "~/helpers/Api";
import axiosDefault from "~/utils/axiosDefault";

const Address = ({
  province,
  setProvince,
  district,
  setDistrict,
  ward,
  setWard,
  address_line,
  setAddressLine,
}) => {
  const [loading, setLoading] = useState(true);
  const [provinces, setProvinces] = useState([]);
  const [districts, setDistricts] = useState([]);
  const [wards, setWards] = useState([]);

  // Fetch API để lấy tỉnh/thành phố
  const fetchProvinces = useCallback(async () => {
    setLoading(true);
    try {
      const response = await axiosDefault.get(Api.provinces());
      const provinces = response.data.data.map((province) => ({
        id: province.ProvinceID,
        label: province.ProvinceName,
      }));
      setProvinces(provinces);
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  }, []);

  // Fetch API để lấy quận/huyện dựa trên province ID
  const fetchDistricts = useCallback(async (provinceId) => {
    setLoading(true);
    try {
      const response = await axiosDefault.get(Api.districts(), {
        params: { province_id: provinceId },
      });
      const districts = response.data.data.map((district) => ({
        id: district.DistrictID,
        label: district.DistrictName,
      }));
      setDistricts(districts);
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  }, []);

  // Fetch API để lấy phường/xã dựa trên district ID
  const fetchWards = useCallback(async (districtId) => {
    setLoading(true);
    try {
      const response = await axiosDefault.get(Api.wards(), {
        params: { district_id: districtId },
      });
      const wards = response.data.data.map((ward) => ({
        id: ward.WardCode,
        label: ward.WardName,
      }));
      setWards(wards);
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => {
    fetchProvinces();
  }, [fetchProvinces]);

  useEffect(() => {
    if (province) {
      fetchDistricts(province.id); // Gọi API lấy quận/huyện khi tỉnh thành được chọn
      setDistrict(null); // Reset quận, huyện khi tỉnh thành thay đổi
      setWard(null); // Reset phường, xã khi tỉnh thành thay đổi
    }
  }, [province, fetchDistricts, setDistrict, setWard]);

  useEffect(() => {
    if (district) {
      fetchWards(district.id); // Gọi API lấy phường/xã khi quận/huyện được chọn
      setWard(null); // Reset phường/xã khi quận, huyện thay đổi
    }
  }, [district, fetchWards, setWard]);

  return (
    <>
      <Autocomplete
        size="small"
        disablePortal
        options={provinces || []}
        sx={{ width: "100%", mt: 1 }}
        fullWidth
        value={province} // Đảm bảo giá trị province luôn có giá trị hợp lệ (null hoặc object)
        onChange={(event, value) => setProvince(value)} // Cập nhật giá trị tỉnh thành
        disabled={loading}
        renderInput={(params) => (
          <TextField {...params} placeholder="Tinh/Thành phố" />
        )}
      />

      <Autocomplete
        size="small"
        disablePortal
        options={districts || []}
        sx={{ width: "100%", mt: 2 }}
        fullWidth
        value={district} // Đảm bảo giá trị district luôn có giá trị hợp lệ (null hoặc object)
        onChange={(event, value) => setDistrict(value)} // Cập nhật giá trị quận huyện
        disabled={loading || !province}
        renderInput={(params) => (
          <TextField {...params} placeholder="Quận/Huyện" />
        )}
      />

      <Autocomplete
        size="small"
        disablePortal
        options={wards || []}
        sx={{ width: "100%", mt: 2 }}
        fullWidth
        value={ward} // Đảm bảo giá trị ward luôn có giá trị hợp lệ (null hoặc object)
        onChange={(event, value) => setWard(value)} // Cập nhật giá trị phường xã
        disabled={loading || !province || !district}
        renderInput={(params) => (
          <TextField {...params} placeholder="Phường/Xã" />
        )}
      />

      <TextField
        size="small"
        sx={{ width: "100%", mt: 2 }}
        fullWidth
        multiline
        rows={3}
        value={address_line || ""}
        onChange={(e) => setAddressLine(e.target.value)}
        placeholder="Tên đường, số nhà,..."
      />
    </>
  );
};

const RegisterSeller = () => {
  const theme = useTheme();
  const navigate = useNavigate();

  const [storeName, setStoreName] = useState("");
  const [onwerName, setOnwerName] = useState("");
  const [phone, setPhone] = useState("");
  const [password, setPassword] = useState("");
  const [description, setDescription] = useState("");
  const [bankName, setBankName] = useState("");
  const [bankNumber, setBankNumber] = useState("");

  const [province, setProvince] = useState(null);
  const [district, setDistrict] = useState(null);
  const [ward, setWard] = useState(null);
  const [address_line, setAddressLine] = useState("");

  const [avatar, setAvatar] = useState(null);
  const [background, setBackground] = useState(null);

  // Hàm xử lý thay đổi ảnh
  const handleAvatarChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onloadend = () => {
        setAvatar(reader.result); // Lưu đường dẫn ảnh vào state
      };
      reader.readAsDataURL(file); // Đọc ảnh thành chuỗi base64
    }
  };

  const handleBackgroundChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onloadend = () => {
        setBackground(reader.result); // Lưu đường dẫn ảnh vào state
      };
      reader.readAsDataURL(file); // Đọc ảnh thành chuỗi base64
    }
  };

  return (
    <Container
      maxWidth="xl"
      sx={{
        minHeight: `calc(100vh - ${theme.custom.headerHeight} - 2 * ${theme.custom.containerGap})`,
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
        borderRadius: "12px",
      }}
    >
      <PaperCustom
        elevation={2}
        sx={{
          textAlign: "center",
          paddingX: 6,
          paddingY: 4,
          width: 1200,
          border: "1px solid",
          borderColor: "primary.light",
        }}
      >
        <Typography variant="h5" sx={{ fontWeight: "bold", mb: 1 }}>
          Đăng Ký Bán Hàng Cùng
        </Typography>

        <Box sx={{ height: "100%", mb: 1 }}>
          <img
            onClick={() => navigate(Path.home())}
            style={{
              display: "block",
              cursor: "pointer",
              objectFit: "cover",
              height: "44px",
              width: "200px",
              margin: "0 auto",
              paddingRight: 10,
            }}
            src={Path.publicLogo2()}
            alt="logo"
          />
        </Box>

        <Grid2 container columns={3} spacing={3}>
          <Grid2 size={1}>
            <TextField
              autoComplete="off"
              fullWidth
              label="Tên cửa hàng"
              variant="outlined"
              margin="normal"
              size="small"
              sx={{ mt: 1 }}
              type="text"
              value={storeName}
              onChange={(e) => setStoreName(e.target.value)}
              // disabled={isLoading || isLoadingGetCode || open}
            />
            <TextField
              autoComplete="off"
              fullWidth
              label="Chủ sở hữu cửa hàng"
              variant="outlined"
              margin="normal"
              size="small"
              sx={{ mt: 1 }}
              type="text"
              value={onwerName}
              onChange={(e) => setOnwerName(e.target.value)}
              // disabled={isLoading || isLoadingGetCode || open}
            />
            <TextField
              autoComplete="off"
              fullWidth
              label="Số điện thoại"
              variant="outlined"
              margin="normal"
              size="small"
              sx={{ mt: 1 }}
              type="text"
              // value={phone}
              // onChange={(e) => setPhone(e.target.value)}
              // disabled={isLoading || isLoadingGetCode || open}
            />
            <TextField
              autoComplete="off"
              fullWidth
              label="Mật khẩu"
              variant="outlined"
              margin="normal"
              size="small"
              sx={{ mt: 1 }}
              type="password"
              // value={password}
              // onChange={(e) => setPassword(e.target.value)}
              // disabled={isLoading || isLoadingGetCode || open}
            />
            <TextField
              autoComplete="off"
              fullWidth
              label="Mô tả cửa hàng"
              variant="outlined"
              margin="normal"
              size="small"
              sx={{ mt: 1 }}
              type="text"
              multiline
              rows={3}
              // value={phone}
              // onChange={(e) => setPhone(e.target.value)}
              // disabled={isLoading || isLoadingGetCode || open}
            />
          </Grid2>

          <Grid2 size={1}>
            <TextField
              autoComplete="off"
              fullWidth
              label="Tên ngân hàng"
              variant="outlined"
              margin="normal"
              size="small"
              sx={{ mt: 1 }}
              type="text"
              // value={phone}
              // onChange={(e) => setPhone(e.target.value)}
              // disabled={isLoading || isLoadingGetCode || open}
            />
            <TextField
              autoComplete="off"
              fullWidth
              label="Số tài khoản ngân hàng"
              variant="outlined"
              margin="normal"
              size="small"
              sx={{ mt: 1 }}
              type="text"
              // value={password}
              // onChange={(e) => setPassword(e.target.value)}
              // disabled={isLoading || isLoadingGetCode || open}
            />

            <Box
              sx={{
                width: "100%",
                height: "146px",
                borderRadius: "4px",
                overflow: "hidden",
                mt: 1,
                backgroundImage: background
                  ? `linear-gradient(to right, rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.6),rgba(0, 0, 0, 0.4),rgba(0, 0, 0, 0.2)), url(${background})`
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
                  gap: 2,
                  width: "100%",
                  height: "100%",
                  p: 2.5,
                }}
              >
                <Box
                  sx={{
                    width: "60px",
                    height: "60px",
                    minWidth: "60px",
                    borderRadius: "4px",
                    overflow: "hidden",
                    backgroundImage: avatar ? `url(${avatar})` : "none",
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

                <Box sx={{ textAlign: "start" }}>
                  <Typography
                    color="white"
                    variant="body1"
                    fontWeight="bold"
                    className="line-clamp-3"
                  >
                    {storeName ? storeName : "Tên cửa hàng"}
                  </Typography>
                  <Typography color="white" variant="body2" sx={{ mt: "2px" }}>
                    {onwerName ? onwerName : "Chủ cửa hàng"}
                  </Typography>
                </Box>
              </Box>
            </Box>

            <Grid2 container columns={2} spacing={2} mt={2}>
              <Grid2 size="grow">
                <Button
                  variant="outlined"
                  component="label"
                  sx={{ width: "100%", height: 36 }}
                >
                  Chọn Avatar
                  <input
                    type="file"
                    accept="image/*"
                    onChange={handleAvatarChange}
                    hidden
                  />
                </Button>
              </Grid2>

              <Grid2>
                <Button
                  variant="outlined"
                  component="label"
                  sx={{ width: "100%", height: 36 }}
                >
                  Chọn Background
                  <input
                    type="file"
                    accept="image/*"
                    onChange={handleBackgroundChange}
                    hidden
                  />
                </Button>
              </Grid2>
            </Grid2>
          </Grid2>

          <Grid2 size={1}>
            <Address
              province={province}
              setProvince={setProvince}
              district={district}
              setDistrict={setDistrict}
              ward={ward}
              setWard={setWard}
              address_line={address_line}
              setAddressLine={setAddressLine}
            />
          </Grid2>
        </Grid2>

        <ButtonLoading
          fullWidth
          sx={{ mt: 2 }}
          variant="contained"
          color="primary"
          // onClick={handleLogin}
          // loading={isLoading}
          // disabled={disabled}
        >
          Đăng ký
        </ButtonLoading>
      </PaperCustom>
    </Container>
  );
};

export default RegisterSeller;
