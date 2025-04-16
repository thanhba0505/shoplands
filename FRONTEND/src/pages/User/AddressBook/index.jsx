import { Box, Container, Divider, Skeleton, Typography } from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Log from "~/helpers/Log";
import axiosWithAuth from "~/utils/axiosWithAuth";

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
    <PaperCustom>
      <Typography variant="h6">Sổ địa chỉ</Typography>

      {loadingAddress ? (
        <Container maxWidth="sm">
          <Skeleton
            animation="pulse"
            variant="circular"
            width={40}
            height={40}
          />
          <Skeleton
            animation="pulse"
            variant="circular"
            width={40}
            height={40}
          />
        </Container>
      ) : (
        address.map((item) => (
          <div key={item.address_id}>
            <Box sx={{ px: 2 }}>
              <Typography>
                {item.ward_name}, {item.district_name}, {item.province_name}
              </Typography>
              <Typography>{item.address_line}</Typography>
            </Box>
            <Divider sx={{ my: 1 }} />
          </div>
        ))
      )}
    </PaperCustom>
  );
};

export default AddressBook;
