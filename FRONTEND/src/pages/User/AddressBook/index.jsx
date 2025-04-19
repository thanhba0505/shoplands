import {
  Autocomplete,
  Box,
  Divider,
  Grid2,
  Skeleton,
  TextField,
  Typography,
} from "@mui/material";
import { useSnackbar } from "notistack";
import { useCallback, useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import ButtonLoading from "~/components/ButtonLoading";
import NoContent from "~/components/NoContent";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Log from "~/helpers/Log";
import axiosDefault from "~/utils/axiosDefault";
import axiosWithAuth from "~/utils/axiosWithAuth";

const AddAddress = ({ fetchApi }) => {
  const { enqueueSnackbar } = useSnackbar();

  const [loadingForm, setLoadingForm] = useState(false);

  const [loading, setLoading] = useState(true);
  const [provinces, setProvinces] = useState([]);
  const [districts, setDistricts] = useState([]);
  const [wards, setWards] = useState([]);

  const [province, setProvince] = useState(null); // Khởi tạo là null để tránh lỗi uncontrolled
  const [district, setDistrict] = useState(null); // Khởi tạo là null
  const [ward, setWard] = useState(null); // Khởi tạo là null
  const [address_line, setAddressLine] = useState("");

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
  }, [province, fetchDistricts]);

  useEffect(() => {
    if (district) {
      fetchWards(district.id); // Gọi API lấy phường/xã khi quận/huyện được chọn
      setWard(null); // Reset phường/xã khi quận, huyện thay đổi
    }
  }, [district, fetchWards]);

  const handleSubmit = async () => {
    setLoadingForm(true);
    try {
      const response = await axiosWithAuth.post(Api.address(), {
        address_line: address_line,
        province_id: province.id,
        district_id: district.id,
        ward_id: ward.id,
        province_name: province.label,
        district_name: district.label,
        ward_name: ward.label,
      });

      enqueueSnackbar(response.data.message, { variant: "success" });
      resetForm();
      fetchApi();
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoadingForm(false);
    }
  };

  const resetForm = () => {
    setDistricts([]);
    setWards([]);
    setProvince(null); // Reset province, district, ward
    setDistrict(null);
    setWard(null);
    setAddressLine(""); // Reset address_line
  };

  return (
    <PaperCustom>
      <Typography variant="subtitle1" sx={{ mb: 1 }}>
        Chọn tỉnh, thành phố
      </Typography>
      <Autocomplete
        size="small"
        disablePortal
        options={provinces || []}
        sx={{ width: "100%" }}
        value={province} // Đảm bảo giá trị province luôn có giá trị hợp lệ (null hoặc object)
        onChange={(event, value) => setProvince(value)} // Cập nhật giá trị tỉnh thành
        disabled={loading}
        renderInput={(params) => (
          <TextField {...params} placeholder="Tinh/Thành phố" />
        )}
      />

      <Typography variant="subtitle1" sx={{ mt: 2, mb: 1 }}>
        Chọn quận, huyện
      </Typography>
      <Autocomplete
        size="small"
        disablePortal
        options={districts || []}
        sx={{ width: "100%" }}
        value={district} // Đảm bảo giá trị district luôn có giá trị hợp lệ (null hoặc object)
        onChange={(event, value) => setDistrict(value)} // Cập nhật giá trị quận huyện
        disabled={loading || !province}
        renderInput={(params) => (
          <TextField {...params} placeholder="Quận/Huyện" />
        )}
      />

      <Typography variant="subtitle1" sx={{ mt: 2, mb: 1 }}>
        Chọn phường, xã
      </Typography>
      <Autocomplete
        size="small"
        disablePortal
        options={wards || []}
        sx={{ width: "100%" }}
        value={ward} // Đảm bảo giá trị ward luôn có giá trị hợp lệ (null hoặc object)
        onChange={(event, value) => setWard(value)} // Cập nhật giá trị phường xã
        disabled={loading || !province || !district}
        renderInput={(params) => (
          <TextField {...params} placeholder="Phường/Xã" />
        )}
      />

      <Typography variant="subtitle1" sx={{ mt: 2, mb: 1 }}>
        Địa chỉ cụ thể
      </Typography>
      <TextField
        size="small"
        fullWidth
        multiline
        rows={3}
        value={address_line || ""}
        onChange={(e) => setAddressLine(e.target.value)}
        placeholder="Tên đường, số nhà,..."
      />

      <Grid2 container spacing={2} sx={{ mt: 2 }} justifyContent={"flex-end"}>
        <Grid2 size={6}>
          <ButtonLoading
            variant="outlined"
            size="lagre"
            fullWidth
            onClick={() => {
              resetForm();
            }}
          >
            Làm mới
          </ButtonLoading>
        </Grid2>

        <Grid2 size={6}>
          <ButtonLoading
            loading={loadingForm}
            variant="contained"
            size="lagre"
            fullWidth
            disabled={!province || !district || !ward || !address_line}
            onClick={() => {
              handleSubmit();
            }}
          >
            Thêm địa chỉ
          </ButtonLoading>
        </Grid2>
      </Grid2>
    </PaperCustom>
  );
};

const AddressBook = () => {
  const navigate = useNavigate();
  const [address, setAddress] = useState([]);
  const [loadingAddress, setLoadingAddress] = useState(true);

  const fetchApi = useCallback(async () => {
    setLoadingAddress(true);
    try {
      const response = await axiosWithAuth.get(Api.userAddress(), {
        navigate,
      });
      setAddress(response.data);
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoadingAddress(false);
    }
  }, [navigate]);

  useEffect(() => {
    fetchApi();
  }, [fetchApi]);

  return (
    <Grid2 height={"100%"} container spacing={3}>
      <Grid2 height={"100%"} size={7}>
        <PaperCustom sx={{ height: "100%" }}>
          {loadingAddress ? (
            <Box>
              <Skeleton
                animation="pulse"
                variant="text"
                width={200}
                height={40}
              />

              <Skeleton
                animation="pulse"
                variant="text"
                width={"80%"}
                height={32}
                sx={{ mt: 1 }}
              />
              <Skeleton
                animation="pulse"
                variant="text"
                width={"50%"}
                height={32}
              />
              <Divider sx={{ my: 1 }} />

              <Skeleton
                animation="pulse"
                variant="text"
                width={"70%"}
                height={32}
                sx={{ mt: 2 }}
              />
              <Skeleton
                animation="pulse"
                variant="text"
                width={"50%"}
                height={32}
              />

              <Divider sx={{ my: 1 }} />

              <Skeleton
                animation="pulse"
                variant="text"
                width={"90%"}
                height={32}
                sx={{ mt: 2 }}
              />
              <Skeleton
                animation="pulse"
                variant="text"
                width={"40%"}
                height={32}
              />
              <Divider sx={{ my: 1 }} />
            </Box>
          ) : (
            <>
              <Typography variant="h6" sx={{ mb: 1 }}>
                Sổ địa chỉ
              </Typography>
              {address.length > 0 ? (
                address.map((item) => (
                  <div key={item.address_id}>
                    <Box sx={{ px: 2, py: 1 }}>
                      <Typography variant="body1" sx={{ fontWeight: "semiBold" }}>
                        {item.ward_name}, {item.district_name},{" "}
                        {item.province_name}
                      </Typography>
                      {item.address_line}
                      <Typography variant="body2" color="success">
                        {item.default == 1 ? " (Mặc định)" : ""}
                      </Typography>
                    </Box>
                    <Divider sx={{ my: 1 }} />
                  </div>
                ))
              ) : (
                <NoContent text="Không có địa chỉ nào" height={"300px"} />
              )}
            </>
          )}
        </PaperCustom>
      </Grid2>

      <Grid2 size={5}>
        <AddAddress fetchApi={fetchApi} />
      </Grid2>
    </Grid2>
  );
};

export default AddressBook;
