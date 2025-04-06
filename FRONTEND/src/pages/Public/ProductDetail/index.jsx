import { Container } from "@mui/material";
import { useNavigate, useParams } from "react-router-dom";
import ProductInfo from "./ProductInfo";
import { useCallback, useEffect, useState } from "react";
import axiosDefault from "~/utils/axiosDefault";
import Api from "~/helpers/Api";
import Path from "~/helpers/Path";
import SimilarProducts from "./SimilarProducts";
import SellerProduct from "./SellerProduct";

const ProductDetail = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const [product, setProduct] = useState([]);
  const [loadingProduct, setLoadingProduct] = useState(false);

  const fetchProducts = useCallback(async () => {
    try {
      const response = await axiosDefault.get(Api.products(id));
      setProduct(response.data);
    } catch (error) {
      console.log(error.response?.data?.message);
      navigate(Path.home());
    }
  }, [navigate, id]);

  
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
      <Container>
        <SimilarProducts />
      </Container>
      <Container>
        <SellerProduct />
      </Container>
    </>
  );
};

export default ProductDetail;
