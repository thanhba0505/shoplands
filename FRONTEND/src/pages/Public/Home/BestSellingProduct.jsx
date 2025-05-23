import { Button, Container, Typography } from "@mui/material";
import { useState, useEffect, useCallback } from "react";
import { useNavigate } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import ShowProducts from "~/components/ShowProducts";
import SkeletonProducts from "~/components/SkeletonProducts";
import Api from "~/helpers/Api";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import axiosDefault from "~/utils/axiosDefault";

const BestSellingProducts = () => {
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
    <Container maxWidth="lg">
      <PaperCustom sx={{ px: 3 }}>
        <Typography variant="h6" sx={{ mt: 2, mb: 3 }} textAlign={"center"}>
          Sản phẩm bán chạy
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
    </Container>
  );
};

export default BestSellingProducts;
