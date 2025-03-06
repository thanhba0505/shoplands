import { Container } from "@mui/material";
import { useNavigate, useParams } from "react-router-dom";
import ProductInfo from "./ProductInfo";
import { useCallback, useEffect, useState } from "react";
import axiosDefault from "~/utils/axiosDefault";
import Api from "~/helpers/Api";
import Path from "~/helpers/Path";

const ProductDetail = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const [product, setProduct] = useState([]);

  // 🔹 Hàm gọi API lấy danh sách sản phẩm bán chạy
  const fetchProducts = useCallback(async () => {
    try {
      const response = await axiosDefault.get(Api.products(id));
      setProduct(response.data);
    } catch (error) {
      console.log(error.response?.data?.message);
      navigate(Path.home());
    }
  }, [navigate, id]);

  // 🔥 Gọi API khi component mount
  useEffect(() => {
    fetchProducts();
  }, [fetchProducts]);

  return (
    <>
      {product && (
        <Container>
          <ProductInfo product={product} />
        </Container>
      )}
    </>
  );
};

export default ProductDetail;
