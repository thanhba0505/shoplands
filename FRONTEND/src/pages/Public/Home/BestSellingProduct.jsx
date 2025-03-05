import {
    Container,
    Box,
    Typography,
    Card,
    CardContent,
    CardMedia,
    Button,
    Rating,
} from "@mui/material";
import { useState, useEffect, useCallback } from "react";
import { useNavigate } from "react-router-dom";
import Api from "~/helpers/Api";
import Format from "~/helpers/Format";
import Path from "~/helpers/Path";
import axiosDefault from "~/utils/axiosDefault";

const BestSellingProducts = () => {
    const navigate = useNavigate();
    const [products, setProducts] = useState([]);

    // 🔹 Hàm gọi API lấy danh sách sản phẩm bán chạy
    const fetchProducts = useCallback(async () => {
        try {
            const response = await axiosDefault.get(Api.products());
            setProducts(response.data);
        } catch (error) {
            if (error.response) {
                navigate(Path.login());
            }
        }
    }, [navigate]);

    // 🔥 Gọi API khi component mount
    useEffect(() => {
        fetchProducts();
    }, [fetchProducts]);

    return (
        <Container maxWidth="lg">
            <Typography variant="h4" gutterBottom>
                Sản phẩm bán chạy
            </Typography>
            <Box
                sx={{
                    display: "flex",
                    flexWrap: "wrap",
                    gap: 2,
                    justifyContent: "space-between",
                }}
            >
                {products &&
                    products.map((product, index) => (
                        <Card
                            key={index}
                            sx={{
                                width: "calc(25% - 16px)",
                                boxShadow: 3,
                                borderRadius: 2,
                            }}
                        >
                            <CardMedia
                                component="img"
                                alt={product.name}
                                height="200"
                                image={Path.publicProduct(
                                    product.images[0].image_path
                                )} // Lấy ảnh đầu tiên của sản phẩm
                                sx={{ objectFit: "cover" }}
                            />
                            <CardContent>
                                {/* Tên sản phẩm */}
                                <Typography
                                    variant="h6"
                                    noWrap
                                    className="line-clamp-2"
                                >
                                    {product.name}
                                </Typography>

                                {/* Rating */}
                                <Box
                                    sx={{
                                        display: "flex",
                                        alignItems: "center",
                                    }}
                                >
                                    <Typography
                                        variant="body2"
                                        color="textSecondary"
                                    >
                                        {product.average_rating}
                                    </Typography>

                                    <Rating
                                        size="small"
                                        name="read-only"
                                        readOnly
                                        value={
                                            product.average_rating
                                                ? parseFloat(
                                                      product.average_rating
                                                  )
                                                : 0
                                        }
                                        precision={0.1}
                                    />
                                    <Typography
                                        variant="body2"
                                        color="textSecondary"
                                        sx={{ marginLeft: 1 }}
                                    >
                                        ({product.count_reviews} đánh giá)
                                    </Typography>
                                </Box>

                                {/* Giá */}
                                <Box
                                    sx={{
                                        display: "flex",
                                        alignItems: "center",
                                        marginTop: 1,
                                    }}
                                >
                                    <Typography
                                        variant="body1"
                                        sx={{
                                            fontWeight: "bold",
                                            marginRight:
                                                product.price_from_min_price
                                                    ? 1
                                                    : 0,
                                        }}
                                    >
                                        {Format.formatCurrency(
                                            product.min_price
                                        )}
                                    </Typography>

                                    {product.price_from_min_price && (
                                        <Typography
                                            variant="body1"
                                            color="error"
                                            sx={{
                                                textDecoration: "line-through",
                                            }}
                                        >
                                            {Format.formatCurrency(
                                                product.price_from_min_price
                                            )}
                                        </Typography>
                                    )}
                                </Box>

                                {/* Lượt bán */}
                                <Typography
                                    variant="body2"
                                    color="textSecondary"
                                    sx={{ marginTop: 1 }}
                                >
                                    Lượt bán: {product.sold_quantity}
                                </Typography>

                                {/* Nút "Xem chi tiết" */}
                                <Button
                                    fullWidth
                                    variant="outlined"
                                    sx={{ marginTop: 2 }}
                                    onClick={() =>
                                        navigate(
                                            Path.productDetail(
                                                product.product_id
                                            )
                                        )
                                    }
                                >
                                    Xem chi tiết
                                </Button>
                            </CardContent>
                        </Card>
                    ))}
            </Box>
        </Container>
    );
};

export default BestSellingProducts;
