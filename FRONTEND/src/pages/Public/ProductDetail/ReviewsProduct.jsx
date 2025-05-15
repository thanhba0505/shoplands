import {
  Avatar,
  Box,
  Grid2,
  Rating,
  Skeleton,
  Typography,
} from "@mui/material";
import React, { useCallback, useEffect, useState } from "react";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Path from "~/helpers/Path";
import axiosDefault from "~/utils/axiosDefault";

const ReviewsProduct = ({ productId }) => {
  const [loading, setLoading] = useState(true);
  const [reviews, setReviews] = useState([]);

  const fetchReviews = useCallback(async () => {
    if (productId) {
      setLoading(true);
      try {
        const response = await axiosDefault.get(Api.reviews(productId));
        setReviews(response.data);
      } catch (error) {
        console.log(error.response?.data?.message);
      } finally {
        setLoading(false);
      }
    }
  }, [productId]);

  useEffect(() => {
    fetchReviews();
  }, [fetchReviews]);

  return (
    <PaperCustom sx={{ px: 3 }}>
      {loading ? (
        <>
          <Skeleton height={40} width={400} sx={{ mb: 1.5, my: 1, px: 2 }} />
          <Grid2 container spacing={2} sx={{ pb: 1.5 }}>
            <Grid2 container size={"auto"} mt={1}>
              <Skeleton height={60} width={60} variant="circular" />
            </Grid2>
            <Grid2 container flexDirection={"column"} size={"grow"} my={1}>
              <Skeleton height={30} width={400} variant="text" />
              <Skeleton height={30} width={600} />
              <Box sx={{ display: "flex", gap: 2 }}>
                <Skeleton height={100} width={100} variant="rounded" />
                <Skeleton height={100} width={100} variant="rounded" />
                <Skeleton height={100} width={100} variant="rounded" />
              </Box>
            </Grid2>
          </Grid2>
        </>
      ) : (
        <>
          <Typography variant="h6" sx={{ mb: 1.5, my: 1 }} textAlign={"start"}>
            Đánh giá sản phẩm
          </Typography>

          {reviews.length === 0 ? (
            <>
              <Typography
                variant="body"
                fontStyle={"italic"}
                sx={{ my: 1, display: "block" }}
                textAlign={"start"}
              >
                Chưa có đánh giá
              </Typography>
            </>
          ) : (
            <Grid2 container spacing={2} sx={{ mt: 2, mb: 2 }}>
              {reviews.map((review) => (
                <Grid2
                  container
                  size={12}
                  key={review.review_id}
                  borderBottom={1}
                  borderColor={"#e0e0e0"}
                >
                  <Grid2 size={"auto"}>
                    <Avatar
                      src={Path.publicAvatar(review.avatar)}
                      sx={{ width: 60, height: 60, m: "auto" }}
                    >
                      {review.name[0]}
                    </Avatar>
                  </Grid2>

                  <Grid2 size={"grow"}>
                    <Typography
                      variant="body"
                      sx={{ my: 0.5, mb: 1, display: "block" }}
                      textAlign={"start"}
                      fontWeight={"bold"}
                    >
                      {review.name}
                    </Typography>

                    <Rating value={review.rating} readOnly size="small" />

                    <Typography
                      variant="body"
                      sx={{ display: "block" }}
                      textAlign={"start"}
                    >
                      {review.comment}
                    </Typography>

                    {review.attributes && review.attributes.length > 0 && (
                      <>
                        <Typography
                          variant="body2"
                          sx={{ display: "block", mt: 1 }}
                          textAlign={"start"}
                        >
                          <i>Phân loại: </i>
                          {review.attributes
                            .map((attr) => attr.attribute_value)
                            .join(", ")}
                        </Typography>
                      </>
                    )}

                    <Box
                      sx={{
                        mt: 1.5,
                        mb: 2,
                        display: "flex",
                        gap: 2,
                        flexWrap: "wrap",
                        alignItems: "end",
                      }}
                    >
                      {review.image_paths &&
                        review.image_paths.map((image, key) => (
                          <React.Fragment key={image.image_path + key}>
                            {image.image_path && (
                              <Avatar
                                src={Path.publicReview(image.image_path)}
                                sx={{
                                  width: 100,
                                  height: 100,
                                  display: "block",
                                }}
                                variant="rounded"
                              />
                            )}
                          </React.Fragment>
                        ))}
                    </Box>
                  </Grid2>
                </Grid2>
              ))}
            </Grid2>
          )}
        </>
      )}
    </PaperCustom>
  );
};

export default ReviewsProduct;
