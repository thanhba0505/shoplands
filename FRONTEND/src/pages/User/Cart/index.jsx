import { useEffect, useState, useCallback } from "react";
import { Button, Container, Grid2, Skeleton, Typography } from "@mui/material";
import axiosWithAuth from "~/utils/axiosWithAuth";
import Api from "~/helpers/Api";
import CartBox from "./CartBox";
import { useNavigate } from "react-router-dom";
import Log from "~/helpers/Log";
import PaperCustom from "~/components/PaperCustom";
import Path from "~/helpers/Path";

const Cart = () => {
  const navigate = useNavigate();

  const [carts, setCarts] = useState([]);
  const [loading, setLoading] = useState(true);

  const fetchCarts = useCallback(async () => {
    setLoading(true);
    try {
      const response = await axiosWithAuth.get(Api.cart(), { navigate });
      setCarts(response.data);
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  }, [navigate]);

  useEffect(() => {
    fetchCarts();
  }, [fetchCarts]);

  const handleDeleteCartSeller = (seller_id) => {
    setCarts((prevCarts) =>
      prevCarts.filter((cart) => cart.seller_id !== seller_id)
    );
  };

  return (
    <>
      {loading ? (
        <Container maxWidth="xl">
          <PaperCustom sx={{ px: 3 }}>
            <Skeleton height={40} width={400} sx={{ mb: 1.5, my: 1, px: 2 }} />
            <Grid2 container spacing={2} sx={{ pb: 1.5 }}>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={2}>
                <Skeleton height={36} width={"100%"} />
              </Grid2>
              <Grid2 container size={3}>
                <Skeleton height={50} width={600} />
              </Grid2>
              <Grid2 container justifyContent={"center"} size={6}>
                <Skeleton height={50} width={300} />
              </Grid2>
              <Grid2 container size={3}>
                <Skeleton height={50} width={600} />
              </Grid2>
            </Grid2>
          </PaperCustom>
        </Container>
      ) : (
        <>
          {carts && carts.length === 0 ? (
            <>
              <Container maxWidth="xl">
                <PaperCustom
                  sx={{
                    display: "flex",
                    justifyContent: "center",
                    alignItems: "center",
                    flexDirection: "column",
                    py: 30,
                  }}
                >
                  <Typography variant="body1">Giỏ hàng trống</Typography>
                  <Button
                    sx={{ px: 2, mt: 1 }}
                    onClick={() => navigate(Path.products())}
                  >
                    Mua ngay
                  </Button>
                </PaperCustom>
              </Container>
            </>
          ) : (
            carts &&
            carts.length > 0 &&
            carts?.map((cart, index) => (
              <Container maxWidth="xl" key={index}>
                <CartBox
                  cart={cart}
                  handleDeleteCartSeller={handleDeleteCartSeller}
                />
              </Container>
            ))
          )}
        </>
      )}
    </>
  );
};

export default Cart;
