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
import ReviewsProduct from "./ReviewsProduct";

const ProductDetail = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const [product, setProduct] = useState([]);
  const [loading, setLoading] = useState(true);

  const [seller, setSeller] = useState(null);

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
        <ProductInfo
          setProduct={setProduct}
          product={product}
          loading={loading}
          sellerStatus={seller?.status}
        />
      </Container>
      <Container>
        <SimilarProducts />
      </Container>
      <Container>
        <ProductDetails
          productDetails={product?.details}
          description={product?.description}
          loading={loading}
        />
      </Container>
      <Container>
        <ReviewsProduct productId={product?.product_id} />
      </Container>
      <Container>
        <SellerProduct
          sellerId={product?.seller_id}
          seller={seller}
          setSeller={setSeller}
        />
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
