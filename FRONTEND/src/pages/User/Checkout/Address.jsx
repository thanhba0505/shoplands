import {
  Box,
  Button,
  FormControl,
  FormControlLabel,
  Grid2,
  Radio,
  RadioGroup,
  Skeleton,
  Typography,
} from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import axiosWithAuth from "~/utils/axiosWithAuth";

const Address = ({ setAddress, address }) => {
  const navigate = useNavigate();
  const [addresses, setAddresses] = useState([]);
  const [loading, setLoading] = useState(true);

  const fetchApi = useCallback(async () => {
    setLoading(true);
    try {
      const response = await axiosWithAuth.get(Api.address(), { navigate });
      setAddresses(response.data);
      if (response.data.length > 0) {
        const defaultAddress = response.data.find((item) => item.default == 1);
        setAddress(defaultAddress);
      }
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  }, [navigate, setAddress]);

  useEffect(() => {
    fetchApi();
  }, [fetchApi]);

  const handleChangeAddress = (e) => {
    const selectedAddress = addresses.find(
      (item) => item.address_id == e.target.value
    );
    setAddress(selectedAddress);
  };

  return (
    <PaperCustom sx={{ px: 3 }}>
      {loading ? (
        <>
          <Skeleton
            variant="rectangular"
            height={30}
            width={400}
            sx={{ mb: 1.5, my: 1, px: 2 }}
          />
          <Grid2 container spacing={8} mt={3}>
            <Grid2 container size={6} spacing={2} alignItems="flex-start">
              <Grid2 size={"auto"}>
                <Skeleton variant="circular" height={20} width={20} />
              </Grid2>
              <Grid2 size={"grow"}>
                <Skeleton variant="rectangular" height={20} width={"100%"} />
                <Skeleton
                  variant="rectangular"
                  height={16}
                  width={"80%"}
                  sx={{ mt: 2 }}
                />
              </Grid2>
            </Grid2>

            <Grid2 container size={6} spacing={2} alignItems="flex-start">
              <Grid2 size={"auto"}>
                <Skeleton variant="circular" height={20} width={20} />
              </Grid2>
              <Grid2 size={"grow"}>
                <Skeleton variant="rectangular" height={20} width={"100%"} />
                <Skeleton
                  variant="rectangular"
                  height={16}
                  width={"80%"}
                  sx={{ mt: 2 }}
                />
              </Grid2>
            </Grid2>
          </Grid2>
          <Skeleton
            variant="rectangular"
            height={24}
            width={200}
            sx={{ mb: 1.5, mt: 3, px: 2 }}
          />
        </>
      ) : (
        <>
          <Typography variant="h6">Địa chỉ</Typography>
          <FormControl sx={{ width: "100%" }}>
            <RadioGroup
              aria-labelledby="demo-controlled-radio-buttons-group"
              name="controlled-radio-buttons-group"
              value={address?.address_id || ""}
              onChange={handleChangeAddress}
              sx={{
                flexDirection: "row",
                justifyContent: "space-between",
                gap: 2,
                py: 1,
              }}
            >
              {addresses && addresses.length > 0 ? (
                addresses.map((item) => (
                  <FormControlLabel
                    key={item.address_id}
                    value={item.address_id}
                    control={<Radio />}
                    sx={{ width: "49%", m: 0 }}
                    label={
                      <Box py={1}>
                        <Typography variant="body1" sx={{ fontWeight: "bold" }}>
                          {item.province_name}
                        </Typography>
                        {item.address_line}
                        <Typography variant="body2" color="success">
                          {item.default == 1 ? " (Mặc định)" : ""}
                        </Typography>
                      </Box>
                    }
                  />
                ))
              ) : (
                <div>Không có địa chỉ</div>
              )}
            </RadioGroup>
          </FormControl>
          <Button
            variant="outlined"
            size="small"
            sx={{ px: 3, mb: 2, mt: 1 }}
            onClick={() => navigate(Path.userAddressBook())}
          >
            Thêm địa chỉ
          </Button>
        </>
      )}
    </PaperCustom>
  );
};

export default Address;
