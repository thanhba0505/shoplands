import { Button, Typography } from "@mui/material";
import { useState, useEffect, useCallback } from "react";
import { useNavigate } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import ShowProducts from "~/components/ShowProducts";
import SkeletonProducts from "~/components/SkeletonProducts";
import Api from "~/helpers/Api";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import axiosDefault from "~/utils/axiosDefault";

const SellerProducts = () => {
  const navigate = useNavigate();
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);

  const fetchProducts = useCallback(async () => {
    setLoading(true);
    try {
      const response = await axiosDefault.get(Api.products(), {
        params: {
          limit: 5,
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
    <PaperCustom sx={{ px: 3 }}>
      <Typography variant="h6" sx={{ mb: 1.5, mt: 1 }} textAlign={"center"}>
        Sản phẩm của cửa hàng
      </Typography>
      {loading ? (
        <SkeletonProducts count={5} columns={10} size={2} />
      ) : (
        <>
          <ShowProducts products={products} columns={10} size={2} />
          <Button
            sx={{ mt: 2, mx: "auto", display: "block", px: 3 }}
            onClick={() => navigate(Path.products())}
          >
            Xem thêm
          </Button>
        </>
      )}
    </PaperCustom>
  );
};

export default SellerProducts;
