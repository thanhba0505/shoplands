import {
  Avatar,
  Button,
  Grid2,
  IconButton,
  TextField,
  Typography,
} from "@mui/material";
import { useCallback, useEffect, useRef, useState } from "react";
import { useDispatch } from "react-redux";
import { useNavigate } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Auth from "~/helpers/Auth";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import { updateUserAvatar, updateUserName } from "~/redux/authSlice";
import axiosWithAuth from "~/utils/axiosWithAuth";
import DriveFileRenameOutlineIcon from "@mui/icons-material/DriveFileRenameOutline";
import CheckCircleOutlinedIcon from "@mui/icons-material/CheckCircleOutlined";
import CancelOutlinedIcon from "@mui/icons-material/CancelOutlined";
import ButtonLoading from "~/components/ButtonLoading";
import { useSnackbar } from "notistack";
import axiosDefault from "~/utils/axiosDefault";
import SkeletonProducts from "~/components/SkeletonProducts";
import ShowProducts from "~/components/ShowProducts";

const SuggestProducts = () => {
  const navigate = useNavigate();
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(false);

  const fetchProducts = useCallback(async () => {
    setLoading(true);
    try {
      const response = await axiosDefault.get(Api.products(), {
        params: {
          limit: 15,
          status: "active",
        },
      });
      setProducts(response.data.products);
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => {
    fetchProducts();
  }, [fetchProducts]);

  return (
    <PaperCustom sx={{ px: 3, mt: 3 }}>
      <Typography variant="h6" sx={{ mt: 2, mb: 3 }} textAlign={"start"}>
        Có thể bạn quan tâm
      </Typography>
      {loading ? (
        <SkeletonProducts count={15} columns={10} size={2} />
      ) : (
        <>
          <ShowProducts products={products} columns={10} size={2} />
          <Button
            sx={{ mt: 2, mx: "auto", display: "block" }}
            onClick={() => navigate(Path.products())}
          >
            Xem thêm
          </Button>
        </>
      )}
    </PaperCustom>
  );
};

const Profile = () => {
  const navigate = useNavigate();
  const fileInputRef = useRef(null);
  const dispatch = useDispatch();
  const { enqueueSnackbar } = useSnackbar();

  const user = Auth.getUser();
  const [avatarFile, setAvatarFile] = useState(null);
  const [previewUrl, setPreviewUrl] = useState(null);
  const [loadingUploadAvatar, setLoadingUploadAvatar] = useState(false);

  const [editingName, setEditingName] = useState(false);
  const [editedName, setEditedName] = useState(user?.name || "");
  const [loadingUpdateName, setLoadingUpdateName] = useState(false);

  const handleChooseFile = () => {
    fileInputRef.current.click();
  };

  const handleFileChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      setAvatarFile(file);
      setPreviewUrl(URL.createObjectURL(file));
    }
  };

  const handleCancel = () => {
    setAvatarFile(null);
    setPreviewUrl(null);
    fileInputRef.current.value = "";
  };

  const handleUpload = useCallback(async () => {
    if (!avatarFile) return;

    setLoadingUploadAvatar(true);
    const formData = new FormData();
    formData.append("avatar", avatarFile);

    try {
      const res = await axiosWithAuth.post(Api.user("avatar"), formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
        navigate,
      });

      dispatch(updateUserAvatar(res.data.avatar));
      handleCancel();
    } catch (err) {
      Log.error(err.response?.data?.message);
      handleCancel();
    } finally {
      setLoadingUploadAvatar(false);
    }
  }, [avatarFile, dispatch, navigate]);

  const handleUpdateName = async () => {
    setLoadingUpdateName(true);
    if (!editedName || editedName === user?.name) {
      setEditingName(false);
      return;
    }

    try {
      const res = await axiosWithAuth.put(Api.user("name"), {
        name: editedName,
      });

      dispatch(updateUserName(res.data.name));
      enqueueSnackbar("Cập nhật tên tài khoản thành công", {
        variant: "success",
      });
      setEditingName(false);
    } catch (err) {
      Log.error(err.response?.data?.message);
      setEditingName(false);
    } finally {
      setLoadingUpdateName(false);
    }
  };

  return (
    <>
      <PaperCustom sx={{ px: 3, py: 3 }}>
        <Grid2 container spacing={4} alignItems={"start"}>
          <Grid2 size={3} container justifyContent={"center"} spacing={2}>
            <Grid2 size={"auto"}>
              <Avatar
                src={previewUrl || Path.publicAvatar(user?.avatar)}
                sx={{ width: 200, height: 200 }}
              >
                {user?.name?.charAt(0).toUpperCase()}
              </Avatar>
              <input
                type="file"
                accept="image/*"
                style={{ display: "none" }}
                ref={fileInputRef}
                onChange={handleFileChange}
              />
            </Grid2>

            <Grid2 size={12} container spacing={2}>
              {avatarFile ? (
                <>
                  <Grid2 size={6}>
                    <Button
                      variant="outlined"
                      color="secondary"
                      fullWidth
                      onClick={handleCancel}
                    >
                      Hủy
                    </Button>
                  </Grid2>
                  <Grid2 size={6}>
                    <ButtonLoading
                      variant="contained"
                      color="primary"
                      fullWidth
                      loading={loadingUploadAvatar}
                      onClick={handleUpload}
                    >
                      Tải lên
                    </ButtonLoading>
                  </Grid2>
                </>
              ) : (
                <Button
                  variant="outlined"
                  color="primary"
                  fullWidth
                  onClick={handleChooseFile}
                >
                  Chọn ảnh mới
                </Button>
              )}
            </Grid2>
          </Grid2>

          <Grid2 container spacing={2} size={9} alignItems={"center"} pt={2}>
            <Grid2 size={"auto"}>
              <Typography variant="body1">
                <b>Họ tên:</b>
              </Typography>
            </Grid2>

            <Grid2 size={"auto"}>
              <TextField
                variant="outlined"
                autoComplete="off"
                size="small"
                sx={{ width: "300px" }}
                value={editedName}
                disabled={!editingName}
                onChange={(e) => setEditedName(e.target.value)}
              />
            </Grid2>

            <Grid2 size={"auto"}>
              {editingName ? (
                <>
                  <IconButton
                    color="error"
                    onClick={() => {
                      setEditedName(user?.name);
                      setEditingName(false);
                    }}
                    disabled={loadingUpdateName}
                  >
                    <CancelOutlinedIcon />
                  </IconButton>
                  <IconButton
                    color="primary"
                    onClick={handleUpdateName}
                    disabled={loadingUpdateName}
                  >
                    <CheckCircleOutlinedIcon />
                  </IconButton>
                </>
              ) : (
                <IconButton
                  onClick={() => setEditingName(true)}
                  disabled={loadingUpdateName}
                >
                  <DriveFileRenameOutlineIcon />
                </IconButton>
              )}
            </Grid2>

            <Grid2 size={12}>
              <Typography variant="body1">
                <b>Số điện thoại:</b> {user?.phone}
              </Typography>
            </Grid2>

            <Grid2 size={12}>
              <Typography variant="body1">
                <b>Mật khẩu:</b>{" "}
                <span
                  style={{
                    borderRight: "2px solid #ccc",
                    paddingRight: "8px",
                    marginRight: "8px",
                  }}
                >
                  ********
                </span>
                <span
                  style={{ cursor: "pointer", color: "blue" }}
                  onClick={() => navigate(Path.resetPassword())}
                >
                  Đổi mật khẩu
                </span>
              </Typography>
            </Grid2>

            <Grid2 size={12}>
              <Typography variant="body1">
                <b>Tham gia vào:</b> {Format.formatDate(user?.created_at)}
              </Typography>
            </Grid2>

            <Grid2 size={12}>
              <Typography variant="body1">
                <b>Trạng thái:</b> {Format.formatStatus(user?.status)}
              </Typography>
            </Grid2>
          </Grid2>
        </Grid2>
      </PaperCustom>

      <SuggestProducts />
    </>
  );
};

export default Profile;
