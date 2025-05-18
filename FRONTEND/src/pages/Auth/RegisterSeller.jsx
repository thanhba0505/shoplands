import { useTheme } from "@emotion/react";
import {
  Autocomplete,
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
import { useSnackbar } from "notistack";

const Address = ({
  loading,
  province,
  setProvince,
  district,
  setDistrict,
  ward,
  setWard,
  address_line,
  setAddressLine,
}) => {
  const [loadingAddress, setLoadingAddress] = useState(true);
  const [provinces, setProvinces] = useState([]);
  const [districts, setDistricts] = useState([]);
  const [wards, setWards] = useState([]);

  // Fetch API để lấy tỉnh/thành phố
  const fetchProvinces = useCallback(async () => {
    setLoadingAddress(true);
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
      setLoadingAddress(false);
    }
  }, []);

  // Fetch API để lấy quận/huyện dựa trên province ID
  const fetchDistricts = useCallback(async (provinceId) => {
    setLoadingAddress(true);
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
      setLoadingAddress(false);
    }
  }, []);

  // Fetch API để lấy phường/xã dựa trên district ID
  const fetchWards = useCallback(async (districtId) => {
    setLoadingAddress(true);
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
      setLoadingAddress(false);
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
        disabled={loadingAddress || loading}
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
        disabled={loadingAddress || loading || !province}
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
        disabled={loadingAddress || loading || !province || !district}
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
        disabled={loading}
      />
    </>
  );
};

const RegisterSeller = () => {
  const theme = useTheme();
  const navigate = useNavigate();
  const { enqueueSnackbar } = useSnackbar();

  const [storeName, setStoreName] = useState("");
  const [ownerName, setOwnerName] = useState("");
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
  const [avatarFile, setAvatarFile] = useState(null);
  const [backgroundFile, setBackgroundFile] = useState(null);

  const [code, setCode] = useState("");

  const [loading, setLoading] = useState(false);
  const [loadingCode, setLoadingCode] = useState(false);
  const [loadingRegister, setLoadingRegister] = useState(false);
  const [open, setOpen] = useState(false);
  const [timeLeft, setTimeLeft] = useState(0);

  const [banks, setBanks] = useState([]);

  const handleAvatarChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onloadend = () => {
        setAvatar(reader.result); // Lưu base64 để preview
      };
      reader.readAsDataURL(file);
      setAvatarFile(file); // Lưu file object để gửi lên server
    }
  };

  const handleBackgroundChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onloadend = () => {
        setBackground(reader.result); // Lưu base64 để preview
      };
      reader.readAsDataURL(file);
      setBackgroundFile(file); // Lưu file object để gửi lên server
    }
  };

  useEffect(() => {
    let timer;
    if (timeLeft > 0) {
      timer = setInterval(() => {
        setTimeLeft((prevTime) => prevTime - 1);
      }, 1000);
    }

    return () => clearInterval(timer);
  }, [timeLeft]);

  const handleGetCode = async () => {
    const formData = new FormData();

    formData.append("store_name", storeName);
    formData.append("owner_name", ownerName);
    formData.append("phone", phone);
    formData.append("description", description);
    formData.append("password", password);
    formData.append("bank_number", bankNumber);
    formData.append("bank_name", bankName);
    formData.append("logo", avatarFile);
    formData.append("background", backgroundFile);
    formData.append("province_id", province.id);
    formData.append("district_id", district.id);
    formData.append("ward_id", ward.id);
    formData.append("province_name", province.label);
    formData.append("district_name", district.label);
    formData.append("ward_name", ward.label);
    formData.append("address_line", address_line);

    setLoading(true);
    setLoadingCode(true);
    if (!open) {
      setLoadingRegister(true);
    }
    try {
      const response = await axiosDefault.post(
        Api.sellers("code-register"),
        formData,
        {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        }
      );

      setOpen(true);
      enqueueSnackbar(response.data.message, { variant: "info" });
      if (response.data.message_body) {
        enqueueSnackbar(response.data.message_body, {
          variant: "info",
          anchorOrigin: {
            vertical: "bottom",
            horizontal: "left",
          },
          autoHideDuration: 10000,
        });
      }
      setTimeLeft(60);
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
      setLoadingCode(false);
      if (!open) {
        setLoadingRegister(false);
      }
    }
  };

  const handleRegister = async () => {
    setLoading(true);
    setLoadingRegister(true);
    try {
      const response = await axiosDefault.post(Api.sellers("register"), {
        phone: phone,
        password: password,
        code: code,
      });

      enqueueSnackbar(response.data.message, { variant: "success" });
      navigate(Path.home());
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
      setLoadingRegister(false);
    }
  };

  const fetchBanks = async () => {
    try {
      const response = await axiosDefault.get(Api.banks());

      const options = response.data.map((bank) => ({
        value: bank.id,
        label: bank.shortName,
      }));

      setBanks(options);
    } catch (error) {
      Log.error(error.response?.data?.message);
    }
  };

  useEffect(() => {
    fetchBanks();
  }, []);

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
            style={{
              display: "block",
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
              disabled={loading || open}
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
              value={ownerName}
              onChange={(e) => setOwnerName(e.target.value)}
              disabled={loading || open}
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
              value={phone}
              onChange={(e) => setPhone(e.target.value)}
              disabled={loading || open}
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
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              disabled={loading || open}
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
              value={description}
              onChange={(e) => setDescription(e.target.value)}
              disabled={loading || open}
            />
          </Grid2>

          <Grid2 size={1}>
            {/* <TextField
              autoComplete="off"
              fullWidth
              label="Tên ngân hàng"
              variant="outlined"
              margin="normal"
              size="small"
              sx={{ mt: 1 }}
              type="text"
              value={bankName}
              onChange={(e) => setBankName(e.target.value)}
              disabled={loading || open}
            /> */}

            <Box sx={{ mt: 1, width: "100%", height: "40px", mb: 1 }}>
              <Autocomplete
                disablePortal
                options={banks}
                fullWidth
                renderInput={(params) => (
                  <TextField {...params} size="small" label="Ngân hàng" />
                )}
                onChange={(e, value) => {
                  setBankName(value?.label || "");
                }}
                disabled={loading || open}
              />
            </Box>

            <TextField
              autoComplete="off"
              fullWidth
              label="Số tài khoản ngân hàng"
              variant="outlined"
              margin="normal"
              size="small"
              sx={{ mt: 1 }}
              type="text"
              value={bankNumber}
              onChange={(e) => setBankNumber(e.target.value)}
              disabled={loading || open}
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

                <Box sx={{ textAlign: "start", mt: "-4px" }}>
                  <Typography
                    color="white"
                    variant="body1"
                    fontWeight="bold"
                    className="line-clamp-3"
                  >
                    {storeName ? storeName : "Tên cửa hàng"}
                  </Typography>
                  <Typography color="white" variant="body2" sx={{ mt: 0.5 }}>
                    {ownerName ? ownerName : "Chủ cửa hàng"}
                  </Typography>
                  <Typography color="white" variant="body2" sx={{ mt: 0.5 }}>
                    Số điện thoại: {phone ? phone : "0XXXXXXXXX"}
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
                  disabled={loading || open}
                >
                  Chọn Avatar
                  <input
                    type="file"
                    accept="image/*"
                    onChange={handleAvatarChange}
                    disabled={loading || open}
                    hidden
                  />
                </Button>
              </Grid2>

              <Grid2>
                <Button
                  variant="outlined"
                  component="label"
                  sx={{ width: "100%", height: 36 }}
                  disabled={loading || open}
                >
                  Chọn Background
                  <input
                    disabled={loading || open}
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
              loading={loading || open}
              province={province}
              setProvince={setProvince}
              district={district}
              setDistrict={setDistrict}
              ward={ward}
              setWard={setWard}
              address_line={address_line}
              setAddressLine={setAddressLine}
            />

            {open && (
              <Grid2 container columns={2} spacing={2} height={40} mt={2}>
                <Grid2 size="grow">
                  <TextField
                    autoComplete="off"
                    fullWidth
                    label="Mã xác thực"
                    variant="outlined"
                    margin="none"
                    size="small"
                    type="text"
                    value={code}
                    onChange={(e) => setCode(e.target.value)}
                    disabled={loading}
                  />
                </Grid2>
                <Grid2>
                  <ButtonLoading
                    loading={loadingCode}
                    variant={"contained"}
                    sx={{ height: "100%", width: 150 }}
                    disabled={timeLeft > 0}
                    onClick={handleGetCode}
                  >
                    Gửi lại mã {timeLeft > 0 ? "(" + timeLeft + ")" : null}
                  </ButtonLoading>
                </Grid2>
              </Grid2>
            )}
          </Grid2>
        </Grid2>

        <ButtonLoading
          fullWidth
          sx={{ mt: 2 }}
          variant="contained"
          color="primary"
          onClick={() => {
            if (open) {
              handleRegister();
            } else {
              handleGetCode();
            }
          }}
          loading={loadingRegister}
          disabled={
            !storeName ||
            !ownerName ||
            !phone ||
            !password ||
            !description ||
            !bankName ||
            !bankNumber ||
            !province ||
            !district ||
            !ward ||
            !address_line ||
            !avatar ||
            !background ||
            (open && code.length < 6)
          }
        >
          Đăng ký bán hàng
        </ButtonLoading>
      </PaperCustom>
    </Container>
  );
};

export default RegisterSeller;
