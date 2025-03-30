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

const ShowProducts = ({ products, columns = 12, size = 2, sx }) => {
  const navigate = useNavigate();

  return (
    <Grid2
      container
      columnSpacing={2}
      rowSpacing={3}
      columns={columns}
      sx={{ ...sx }}
    >
      {products &&
        products.map((product, index) => (
          <Grid2 key={index} size={size}>
            <Card
              sx={{
                boxShadow: 1,
                borderRadius: 2,
                height: "360px",
                cursor: "pointer",
                transition: "transform 0.3s ease-out, box-shadow 0.3s ease-out",
                "& img": {
                  transition: "transform 0.3s ease-out",
                },
                "&:hover": {
                  boxShadow: 3,
                  transform: "scale(1.02)",
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
                height="200"
                image={Path.publicProduct(product.images[0].image_path)} // Lấy ảnh đầu tiên của sản phẩm
                sx={{ objectFit: "cover" }}
              />
              <CardContent>
                {/* Tên sản phẩm */}
                <Box>
                  <Typography
                    sx={{ flexGrow: 1 }}
                    variant="body2"
                    noWrap
                    className="line-clamp-2"
                  >
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
                      fontSize={18}
                      sx={{
                        fontWeight: "bold",
                        mt: 1,
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
                  <Box
                    sx={{
                      display: "flex",
                      alignItems: "center",
                      mt: 1,
                      gap: 0.5,
                    }}
                  >
                    <Rating
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
                    <Typography
                      color="textSecondary"
                      sx={{ mt: "1px" }}
                      fontSize={11}
                    >
                      ({product.average_rating})
                    </Typography>
                  </Box>

                  {/* Lượt dánh giá */}
                  <Box
                    sx={{
                      display: "flex",
                      alignItems: "end",
                      justifyContent: "space-between",
                      alignContent: "flex-end",
                      gap: 1,
                      mt: 1,
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
                </Box>
              </CardContent>
            </Card>
          </Grid2>
        ))}
    </Grid2>
  );
};

export default ShowProducts;
