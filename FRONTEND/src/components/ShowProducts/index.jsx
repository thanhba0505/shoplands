import {
  Box,
  Typography,
  Card,
  CardContent,
  CardMedia,
  Rating,
  Grid2,
} from "@mui/material";
import { useNavigate } from "react-router-dom";
import Format from "~/helpers/Format";
import Path from "~/helpers/Path";

const ShowProducts = ({ products, columns = 12, size = 2 }) => {
  const navigate = useNavigate();

  return (
    <Grid2 container columnSpacing={2} rowSpacing={3} columns={columns}>
      {products &&
        products.map((product, index) => (
          <Grid2 key={index} size={size}>
            <Card
              sx={{
                boxShadow: 1,
                borderRadius: 2,
                cursor: "pointer",
                transition: "all 0.3s ease-out",
                "& img": {
                  transition: "all 0.3s ease-out",
                },
                "&:hover": {
                  boxShadow: 3,
                  scale: 1.02,
                  "& img": {
                    transform: "scale(1.05)",
                  },
                },
              }}
              onClick={() => navigate(Path.productDetail(product.product_id))}
            >
              <CardMedia
                component="img"
                alt={product.name}
                // height="100"
                image={Path.publicProduct(product.images[0].image_path)} // Lấy ảnh đầu tiên của sản phẩm
                sx={{ objectFit: "cover" }}
              />
              <CardContent>
                {/* Tên sản phẩm */}
                <Typography variant="body2" noWrap className="line-clamp-2">
                  {product.name}
                </Typography>

                {/* Giá */}
                <Box
                  sx={{
                    display: "flex",
                    alignItems: "end",
                    marginTop: 1,
                  }}
                >
                  <Typography
                    variant="body1"
                    color="error"
                    lineHeight={1}
                    sx={{
                      fontWeight: "bold",
                      marginRight: product.price_from_min_price ? 1 : 0,
                    }}
                  >
                    {Format.formatCurrency(product.min_price)}
                  </Typography>

                  {product.price_from_min_price && (
                    <Typography
                      fontSize={13}
                      lineHeight={1}
                      color="error"
                      sx={{
                        textDecoration: "line-through",
                      }}
                    >
                      {Format.formatCurrency(product.price_from_min_price)}
                    </Typography>
                  )}
                </Box>

                {/* Rating */}
                <Rating
                  sx={{ mt: 1 }}
                  size="small"
                  name="read-only"
                  readOnly
                  value={
                    product.average_rating
                      ? parseFloat(product.average_rating)
                      : 0
                  }
                  precision={0.1}
                />

                {/* Lượt dánh giá */}
                <Box
                  sx={{
                    display: "flex",
                    alignItems: "end",
                    justifyContent: "space-between",
                    gap: 1,
                  }}
                >
                  <Typography
                    fontSize={11}
                    lineHeight={1}
                    color="textSecondary"
                  >
                    ({product.count_reviews} đánh giá)
                  </Typography>

                  <Typography
                    fontSize={12}
                    lineHeight={1}
                    color="textSecondary"
                  >
                    Đã bán: {product.sold_quantity}
                  </Typography>
                </Box>

                {/* Lượt bán */}
              </CardContent>
            </Card>
          </Grid2>
        ))}
    </Grid2>
  );
};

export default ShowProducts;
