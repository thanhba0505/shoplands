import { Container } from "@mui/material";
import { useNavigate, useParams } from "react-router-dom";
import ProductInfo from "./ProductInfo";
import { useCallback, useEffect, useState } from "react";
import axiosDefault from "~/utils/axiosDefault";
import Path from "~/helpers/Path";
import Api from "~/helpers/Api";

const ProductDetail = () => {
    const { id } = useParams();
    const navigate = useNavigate();
    const [products, setProduct] = useState([]);

    // 🔹 Hàm gọi API lấy danh sách sản phẩm bán chạy
    const fetchProducts = useCallback(async () => {
        try {
            const response = await axiosDefault.get(Api.products(id));
            setProduct(response.data);
        } catch (error) {
            if (error.response) {
                navigate(Path.login());
            }
        }
    }, [navigate, id]);

    // 🔥 Gọi API khi component mount
    useEffect(() => {
        fetchProducts();
    }, [fetchProducts]);

    return (
        <>
            {products && (
                <Container>
                    <ProductInfo product={products} />
                </Container>
            )}
        </>
    );
};

export default ProductDetail;
