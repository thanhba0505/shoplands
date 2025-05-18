import {
  Autocomplete,
  Box,
  Button,
  Divider,
  Grid2,
  Skeleton,
  TextField,
  Typography,
} from "@mui/material";
import { useCallback, useEffect, useState, useRef } from "react";
import { useNavigate } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import DriveFileRenameOutlineIcon from "@mui/icons-material/DriveFileRenameOutline";
import PublishRoundedIcon from "@mui/icons-material/PublishRounded";
import HideImageRoundedIcon from "@mui/icons-material/HideImageRounded";
import CheckCircleOutlineIcon from "@mui/icons-material/CheckCircleOutline";
import CancelIcon from "@mui/icons-material/Cancel";
import axiosDefault from "~/utils/axiosDefault";
import { useSnackbar } from "notistack";
import axiosWithAuth from "~/utils/axiosWithAuth";
import { useDispatch } from "react-redux";
import { updateSellerBackground, updateSellerLogo } from "~/redux/authSlice";
import ButtonLoading from "~/components/ButtonLoading";

const SellerBanner = ({ seller, setSeller, loading, setLoading }) => {
  const navigate = useNavigate();
  const backgroundInputRef = useRef(null);
  const logoInputRef = useRef(null);
  const { enqueueSnackbar } = useSnackbar();
  const dispatch = useDispatch();

  const [selectedLogo, setSelectedLogo] = useState(null);
  const [selectedBackground, setSelectedBackground] = useState(null);
  const [logoPreviewUrl, setLogoPreviewUrl] = useState(null);
  const [backgroundPreviewUrl, setBackgroundPreviewUrl] = useState(null);
  const [isLogoEditing, setIsLogoEditing] = useState(false);
  const [isBackgroundEditing, setIsBackgroundEditing] = useState(false);
  const [uploadingLogo, setUploadingLogo] = useState(false);
  const [uploadingBackground, setUploadingBackground] = useState(false);

  const fetchSeller = useCallback(async () => {
    setLoading(true);
    try {
      const response = await axiosWithAuth.get(Api.seller());
      setSeller(response.data);
    } catch (error) {
      Log.error(error.response?.data?.message);
      navigate(Path.home());
    } finally {
      setLoading(false);
    }
  }, [navigate, setSeller, setLoading]);

  // call api
  useEffect(() => {
    fetchSeller();
  }, [fetchSeller]);

  // Clear preview URLs when component unmounts
  useEffect(() => {
    return () => {
      if (logoPreviewUrl) {
        URL.revokeObjectURL(logoPreviewUrl);
      }
      if (backgroundPreviewUrl) {
        URL.revokeObjectURL(backgroundPreviewUrl);
      }
    };
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, []);

  const handleLogoChange = (event) => {
    const file = event.target.files[0];
    if (file) {
      setSelectedLogo(file);
      const fileUrl = URL.createObjectURL(file);
      setLogoPreviewUrl(fileUrl);
      setIsLogoEditing(true);
    }
  };

  const handleBackgroundChange = (event) => {
    const file = event.target.files[0];
    if (file) {
      setSelectedBackground(file);
      const fileUrl = URL.createObjectURL(file);
      setBackgroundPreviewUrl(fileUrl);
      setIsBackgroundEditing(true);
    }
  };

  const handleLogoCancel = () => {
    if (logoPreviewUrl) {
      URL.revokeObjectURL(logoPreviewUrl);
    }
    setSelectedLogo(null);
    setLogoPreviewUrl(null);
    setIsLogoEditing(false);
  };

  const handleBackgroundCancel = () => {
    if (backgroundPreviewUrl) {
      URL.revokeObjectURL(backgroundPreviewUrl);
    }
    setSelectedBackground(null);
    setBackgroundPreviewUrl(null);
    setIsBackgroundEditing(false);
  };

  const handleLogoUpdate = async () => {
    if (!selectedLogo) return;

    setUploadingLogo(true);
    try {
      const formData = new FormData();
      formData.append("logo", selectedLogo);

      const response = await axiosWithAuth.post(Api.sellerLogo(), formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      });

      // Update the seller information
      // fetchSeller();
      dispatch(updateSellerLogo(response.data.logo));
      setSeller((prevSeller) => ({
        ...prevSeller,
        logo: response.data.logo,
      }));
      setIsLogoEditing(false);
      setSelectedLogo(null);
      if (logoPreviewUrl) {
        URL.revokeObjectURL(logoPreviewUrl);
        setLogoPreviewUrl(null);
      }
      enqueueSnackbar(response.data.message, { variant: "success" });
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setUploadingLogo(false);
    }
  };

  const handleBackgroundUpdate = async () => {
    if (!selectedBackground) return;

    setUploadingBackground(true);
    try {
      const formData = new FormData();
      formData.append("background", selectedBackground);

      const response = await axiosWithAuth.post(
        Api.sellerBackground(),
        formData,
        {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        }
      );

      // Update the seller information
      // fetchSeller();
      dispatch(updateSellerBackground(response.data.background));
      setSeller((prevSeller) => ({
        ...prevSeller,
        background: response.data.background,
      }));
      setIsBackgroundEditing(false);
      setSelectedBackground(null);
      if (backgroundPreviewUrl) {
        URL.revokeObjectURL(backgroundPreviewUrl);
        setBackgroundPreviewUrl(null);
      }
      enqueueSnackbar(response.data.message, { variant: "success" });
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setUploadingBackground(false);
    }
  };

  const background = seller?.background ?? null;
  const avatar = seller?.logo ?? null;
  const storeName = seller?.store_name ?? null;
  const ownerName = seller?.owner_name ?? null;
  const phone = seller?.phone ?? null;

  // Determine which images to display (preview or current)
  const currentBackgroundImage =
    isBackgroundEditing && backgroundPreviewUrl
      ? `url(${backgroundPreviewUrl})`
      : background
      ? `linear-gradient(to right, rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.6),rgba(0, 0, 0, 0.4),rgba(0, 0, 0, 0.2)), url(${Path.publicBackground(
          background
        )})`
      : "none";

  const currentLogoImage =
    isLogoEditing && logoPreviewUrl
      ? `url(${logoPreviewUrl})`
      : avatar
      ? `url(${Path.publicAvatar(avatar)})`
      : "none";

  return (
    <PaperCustom sx={{ p: 0 }}>
      {loading ? (
        <Grid2 container sx={{ width: "100%", height: "400px", p: 8, gap: 6 }}>
          <Grid2 height={"100%"}>
            <Skeleton
              height={200}
              width={200}
              variant="rounded"
              sx={{ borderRadius: "20px" }}
            />
          </Grid2>
          <Grid2 height={"100%"} flexGrow={1}>
            <Skeleton variant="text" sx={{ fontSize: 32 }} width={"70%"} />
            <Skeleton
              variant="text"
              sx={{ fontSize: 16, mt: 1 }}
              width={"40%"}
            />
            <Skeleton
              variant="text"
              sx={{ fontSize: 16, mt: 1 }}
              width={"50%"}
            />
            <Skeleton
              variant="text"
              sx={{ fontSize: 16, mt: 1 }}
              width={"20%"}
            />
            <Skeleton
              variant="text"
              sx={{ fontSize: 16, mt: 1 }}
              width={"30%"}
            />
            <Skeleton
              variant="text"
              sx={{ fontSize: 16, mt: 1 }}
              width={"25%"}
            />
          </Grid2>
        </Grid2>
      ) : (
        <Box
          sx={{
            width: "100%",
            height: "400px",
            borderRadius: "12px",
            overflow: "hidden",
            backgroundImage: currentBackgroundImage,
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
              gap: 6,
              width: "100%",
              height: "100%",
              p: 8,
              "&:hover button.background-button": {
                opacity: 1,
              },
            }}
          >
            <input
              ref={backgroundInputRef}
              type="file"
              accept="image/*"
              style={{ display: "none" }}
              onChange={handleBackgroundChange}
            />

            <Box
              sx={{
                bottom: 0,
                left: 0,
                width: "200px",
                zIndex: 1,
                position: "absolute",
                mb: 8,
                ml: 8,
                display: "flex",
                flexDirection: "column",
                gap: 1,
              }}
            >
              {isBackgroundEditing ? (
                <Grid2 container spacing={1}>
                  <Grid2 size={"grow"}>
                    <Button
                      variant="contained"
                      size="small"
                      color="error"
                      fullWidth
                      startIcon={<CancelIcon />}
                      sx={{ opacity: 1 }}
                      onClick={handleBackgroundCancel}
                      disabled={uploadingBackground}
                    >
                      Hủy
                    </Button>
                  </Grid2>
                  <Grid2 size={"auto"}>
                    <Button
                      variant="contained"
                      size="small"
                      color="success"
                      startIcon={<CheckCircleOutlineIcon />}
                      sx={{ opacity: 1 }}
                      onClick={handleBackgroundUpdate}
                      disabled={uploadingBackground}
                    >
                      Cập nhật
                    </Button>
                  </Grid2>
                </Grid2>
              ) : (
                <Button
                  variant="contained"
                  size="small"
                  fullWidth
                  className="background-button"
                  startIcon={<DriveFileRenameOutlineIcon />}
                  sx={{ opacity: 0, transition: "opacity 0.3s ease" }}
                  onClick={() => backgroundInputRef.current.click()}
                >
                  Đổi hình nền
                </Button>
              )}
            </Box>

            <Box
              sx={{
                width: "200px",
                height: "200px",
                minWidth: "200px",
                borderRadius: "20px",
                overflow: "hidden",
                backgroundImage: currentLogoImage,
                backgroundColor: "#fff",
                backgroundSize: "cover",
                backgroundPosition: "center",
                display: "flex",
                justifyContent: "center",
                alignItems: "center",
                boxShadow: "0px 0px 8px #fff",
                position: "relative",
              }}
            >
              {!avatar && !logoPreviewUrl && (
                <HideImageRoundedIcon fontSize="medium" />
              )}

              <input
                ref={logoInputRef}
                type="file"
                accept="image/*"
                style={{ display: "none" }}
                onChange={handleLogoChange}
              />

              {isLogoEditing ? (
                <Box
                  sx={{
                    position: "absolute",
                    top: 0,
                    left: 0,
                    width: "100%",
                    height: "100%",
                    backgroundColor: "rgba(0, 0, 0, 0.6)",
                    color: "#fff",
                    display: "flex",
                    justifyContent: "center",
                    alignItems: "center",
                    flexDirection: "column",
                    gap: 1,
                  }}
                >
                  <Box sx={{ display: "flex", gap: 1 }}>
                    <Button
                      variant="contained"
                      size="small"
                      color="error"
                      onClick={handleLogoCancel}
                      disabled={uploadingLogo}
                    >
                      <CancelIcon />
                    </Button>
                    <ButtonLoading
                      variant="contained"
                      size="small"
                      color="success"
                      onClick={handleLogoUpdate}
                      loading={uploadingLogo}
                    >
                      <CheckCircleOutlineIcon />
                    </ButtonLoading>
                  </Box>
                </Box>
              ) : (
                <Box
                  sx={{
                    position: "absolute",
                    top: 0,
                    right: 0,
                    width: "100%",
                    height: "100%",
                    backgroundColor: "transparent",
                    color: "#fff",
                    display: "flex",
                    justifyContent: "center",
                    alignItems: "center",
                    flexDirection: "column",
                    cursor: "pointer",
                    transition: "background-color 0.3s ease",
                    "&:hover": {
                      backgroundColor: "rgba(0, 0, 0, 0.6)",
                      "& svg": { opacity: 1 },
                      "& .upload-text": { opacity: 1 },
                    },
                    "& svg": {
                      opacity: 0,
                      transition: "opacity 0.3s ease",
                    },
                    "& .upload-text": {
                      opacity: 0,
                      transition: "opacity 0.3s ease",
                    },
                  }}
                  onClick={() => logoInputRef.current.click()}
                >
                  <PublishRoundedIcon fontSize="large" />
                  <Typography className="upload-text" variant="body1">
                    Tải ảnh lên
                  </Typography>
                </Box>
              )}
            </Box>

            <Box sx={{ textAlign: "start", mt: "-4px", flexGrow: 1 }}>
              <Typography
                color="white"
                variant="body1"
                fontSize={32}
                fontWeight="bold"
                className="line-clamp-3"
              >
                {storeName}
              </Typography>
              <Typography
                color="white"
                variant="body2"
                fontSize={16}
                sx={{ mt: 0.5 }}
              >
                Chủ cửa hàng: {ownerName}
              </Typography>
              <Typography
                color="white"
                variant="body2"
                fontSize={16}
                sx={{ mt: 0.5 }}
              >
                Số điện thoại: {phone}
              </Typography>
              <Typography
                color="white"
                variant="body2"
                fontSize={16}
                sx={{ mt: 0.5 }}
              >
                Trạng thái: {Format.formatStatus(seller?.status)}
              </Typography>
              <Divider sx={{ my: 2, backgroundColor: "#fff", width: "50%" }} />
              <Typography
                color="white"
                variant="body2"
                fontSize={16}
                sx={{ mt: 0.5 }}
              >
                Lượt đánh giá: {seller?.review_count ?? 0}
              </Typography>
              <Typography
                color="white"
                variant="body2"
                fontSize={16}
                sx={{ mt: 0.5 }}
              >
                Đánh giá trung bình: {seller?.average_rating ?? 0}
              </Typography>
              <Typography
                color="white"
                variant="body2"
                fontSize={16}
                sx={{ mt: 0.5 }}
              >
                Số sản phẩm: {seller?.product_count ?? 0}
              </Typography>
            </Box>
          </Box>
        </Box>
      )}
    </PaperCustom>
  );
};

const Settings = () => {
  const navigate = useNavigate();
  const [seller, setSeller] = useState(null);
  const [updateLoading, setUpdateLoading] = useState(false);

  const [edit, setEdit] = useState(false);
  const [loading, setLoading] = useState(true);

  const [banks, setBanks] = useState([]);

  const [editOwnerName, setEditOwnerName] = useState("");
  const [editDescription, setEditDescription] = useState("");
  const [editBankNumber, setEditBankNumber] = useState("");
  const [editBankName, setEditBankName] = useState("");

  const resetForm = () => {
    setEditOwnerName(seller.owner_name);
    setEditDescription(seller.description);
    setEditBankNumber(seller.bank_number);
    setEditBankName(seller.bank_name);
    setEdit(false);
  };

  useEffect(() => {
    if (seller) {
      setEditOwnerName(seller.owner_name);
      setEditDescription(seller.description);
      setEditBankNumber(seller.bank_number);
      setEditBankName(seller.bank_name);
    }
  }, [seller]);

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

  const fetchUpdate = async () => {
    setUpdateLoading(true);
    try {
      await axiosWithAuth.put(
        Api.seller(),
        {
          owner_name: editOwnerName,
          description: editDescription,
          bank_number: editBankNumber,
          bank_name: editBankName,
        },
        {
          navigate,
        }
      );
      setSeller((prevSeller) => ({
        ...prevSeller,
        owner_name: editOwnerName,
        description: editDescription,
        bank_number: editBankNumber,
        bank_name: editBankName,
      }));
      resetForm();
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setUpdateLoading(false);
    }
  };

  return (
    <>
      <SellerBanner
        seller={seller}
        setSeller={setSeller}
        loading={loading}
        setLoading={setLoading}
      />

      <PaperCustom sx={{ px: 3, mt: 3 }}>
        {loading ? (
          <>
            <Skeleton variant="text" height={40} width={400} />
            <Skeleton variant="text" width={200} />
            <Skeleton variant="text" width={350} />
            <Skeleton variant="text" width={520} />
            <Skeleton variant="text" width={370} />
            <Skeleton variant="text" width={240} />
            <Skeleton variant="text" width={330} />
            <Skeleton variant="text" width={240} />
          </>
        ) : (
          <>
            <Typography variant="h6" fontWeight={"bold"} sx={{ pb: 2 }}>
              Thông tin cửa hàng
            </Typography>

            <Box sx={{ mb: 1 }}>
              <Typography variant="body1" component="span">
                <b>Số điện thoại:</b> {seller?.phone}
              </Typography>
            </Box>

            <Box sx={{ mb: 1 }}>
              <Typography variant="body1" component="span">
                <b>Tên cửa hàng:</b> {seller?.store_name}
              </Typography>
            </Box>

            <Box sx={{ mb: 1, display: "flex", alignItems: "start" }}>
              <Typography variant="body1" component="span">
                <b>Chủ cửa hàng:</b>
              </Typography>
              {edit ? (
                <TextField
                  sx={{ width: "500px", ml: 1 }}
                  value={editOwnerName}
                  onChange={(e) => setEditOwnerName(e.target.value)}
                  size="small"
                />
              ) : (
                <Typography variant="body1" component="span" sx={{ ml: 1 }}>
                  {seller?.owner_name}
                </Typography>
              )}
            </Box>

            <Box sx={{ mb: 1, mt: 1.5, display: "flex", alignItems: "start" }}>
              <Typography variant="body1" component="span">
                <b>Mô tả:</b>
              </Typography>
              {edit ? (
                <TextField
                  sx={{ width: "600px", ml: 1 }}
                  value={editDescription}
                  multiline
                  rows={4}
                  onChange={(e) => setEditDescription(e.target.value)}
                  size="small"
                />
              ) : (
                <Typography variant="body1" component="span" sx={{ ml: 1 }}>
                  {seller?.description}
                </Typography>
              )}
            </Box>

            <Box sx={{ mb: 1, mt: 1.5, display: "flex", alignItems: "start" }}>
              <Typography variant="body1" component="span">
                <b>Tên ngân hàng:</b>
              </Typography>
              {edit ? (
                <Box sx={{ ml: 1, width: "500px" }}>
                  <Autocomplete
                    disablePortal
                    options={banks}
                    value={banks.find((bank) => bank.label === editBankName)}
                    fullWidth
                    renderInput={(params) => (
                      <TextField
                        {...params}
                        size="small"
                        placeholder="Chọn ngân hàng"
                      />
                    )}
                    onChange={(e, value) => {
                      setEditBankName(value?.label || "");
                    }}
                    disabled={!banks}
                  />
                </Box>
              ) : (
                <Typography variant="body1" component="span" sx={{ ml: 1 }}>
                  {seller?.bank_name ?? <i>Chưa thiết lập</i>}
                </Typography>
              )}
            </Box>

            <Box sx={{ mb: 1, mt: 1.5, display: "flex", alignItems: "start" }}>
              <Typography variant="body1" component="span">
                <b>Số tài khoản:</b>
              </Typography>
              {edit ? (
                <TextField
                  sx={{ width: "500px", ml: 1 }}
                  placeholder="Số tài khoản ngân hàng"
                  value={editBankNumber}
                  onChange={(e) => setEditBankNumber(e.target.value)}
                  size="small"
                />
              ) : (
                <Typography variant="body1" component="span" sx={{ ml: 1 }}>
                  {seller?.bank_number ?? <i>Chưa thiết lập</i>}
                </Typography>
              )}
            </Box>

            {edit ? (
              <Box sx={{ my: 2 }}>
                <Button
                  variant="outlined"
                  onClick={() => resetForm()}
                  disabled={updateLoading ? true : false}
                >
                  Hủy
                </Button>
                <Button
                  variant="contained"
                  onClick={() => fetchUpdate()}
                  disabled={
                    !editOwnerName ||
                    !editDescription ||
                    !editBankName ||
                    !editBankNumber
                  }
                  sx={{ ml: 2 }}
                  loading={updateLoading}
                >
                  Lưu
                </Button>
              </Box>
            ) : (
              <Button
                variant="contained"
                sx={{ my: 2 }}
                onClick={() => setEdit(true)}
              >
                Chỉnh sửa
              </Button>
            )}
          </>
        )}
      </PaperCustom>
    </>
  );
};

export default Settings;
