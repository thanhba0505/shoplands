import { Container } from "@mui/material";
import { useNavigate, useParams } from "react-router-dom";
import ProductInfo from "./ProductInfo";
import { useCallback, useEffect, useState } from "react";
import axiosDefault from "~/utils/axiosDefault";
import Api from "~/helpers/Api";
import Path from "~/helpers/Path";
import SimilarProducts from "./SimilarProducts";
import SellerProduct from "./SellerProduct";
import ProductDetails from "./ProductDetails";
import SellerProducts from "./SellerProducts";
import SuggestProducts from "./SuggestProducts";

const ProductDetail = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const [product, setProduct] = useState([]);
  const [loading, setLoading] = useState(true);

  const fetchProducts = useCallback(async () => {
    setLoading(true);
    try {
      const response = await axiosDefault.get(Api.products(id));
      setProduct(response.data);
    } catch (error) {
      console.log(error.response?.data?.message);
      navigate(Path.home());
    } finally {
      setLoading(false);
    }
  }, [navigate, id]);

  useEffect(() => {
    fetchProducts();
  }, [fetchProducts]);

  return (
    <>
      <Container>
        <ProductInfo product={product} loading={loading} />
      </Container>
      <Container>
        <SimilarProducts />
      </Container>
      <Container>
        <ProductDetails productDetails={product?.details} description={product?.description} loading={loading} />
      </Container>
      <Container>
        <SellerProduct sellerId={product?.seller_id} />
      </Container>
      <Container>
        <SellerProducts />
      </Container>
      <Container>
        <SuggestProducts />
      </Container>
    </>
  );
};

export default ProductDetail;
