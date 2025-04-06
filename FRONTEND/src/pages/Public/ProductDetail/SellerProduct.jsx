import { Avatar, Grid2, Skeleton, Typography } from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import axiosDefault from "~/utils/axiosDefault";

const SellerProduct = ({ sellerId }) => {
  const [seller, setSeller] = useState(null);
  const [loading, setLoading] = useState(true);

  const fetchApi = useCallback(async () => {
    setLoading(true);
    try {
      if (sellerId) {
        const response = await axiosDefault.get(Api.sellers(sellerId));
        setSeller(response.data);
      }
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  }, [sellerId]);

  useEffect(() => {
    fetchApi();
  }, [fetchApi]);

  return (
    <PaperCustom sx={{ px: 3 }}>
      <Grid2 container spacing={3} alignItems={"center"} sx={{ my: 2 }}>
        <Grid2 size={"auto"}>
          {loading ? (
            <Skeleton
              animation="pulse"
              variant="circular"
              width={100}
              height={100}
            />
          ) : (
            <Avatar
              sx={{ width: "100px", height: "100px" }}
              src={Path.publicAvatar(seller?.logo)}
              alt="logo"
            />
          )}
        </Grid2>
        <Grid2>
          {loading ? (
            <>
              <Skeleton
                animation="pulse"
                variant="text"
                width={200}
                height={32}
              />
              <Skeleton
                animation="pulse"
                variant="text"
                width={300}
                height={24}
              />
              <Skeleton
                animation="pulse"
                variant="text"
                width={500}
                height={24}
              />
            </>
          ) : (
            <>
              <Typography variant="h6" fontWeight={"bold"}>
                {seller?.store_name}
              </Typography>
              <Typography variant="body1">
                Chủ cửa hàng: {seller?.owner_name}
              </Typography>
              <Typography variant="body1">{seller?.description}</Typography>
            </>
          )}
        </Grid2>
      </Grid2>
    </PaperCustom>
  );
};

export default SellerProduct;
