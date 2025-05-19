import {
  Container,
  Box,
  Typography,
  Avatar,
  Grid2,
  Skeleton,
} from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import axiosDefault from "~/utils/axiosDefault";

const CategoryList = () => {
  const navigate = useNavigate();
  const [categories, setCategories] = useState([]);
  const [loading, setLoading] = useState(true);

  const fetchCarts = useCallback(async () => {
    setLoading(true);
    try {
      const response = await axiosDefault.get(Api.categories());
      setCategories(response.data);
    } catch (error) {
      Log.error(error.response?.data?.message);
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => {
    fetchCarts();
  }, [fetchCarts]);

  return (
    <Container maxWidth="lg">
      <PaperCustom>
        <Typography variant="h6" sx={{ mt: 2 }} textAlign={"center"}>
          Danh mục sản phẩm
        </Typography>
        {loading ? (
          <Grid2 container spacing={2} height={404.3}>
            <Grid2
              container
              justifyContent={"center"}
              size={2}
              alignItems={"center"}
              flexDirection={"column"}
              pt={2}
            >
              <Skeleton variant="circular" height={120} width={120} />
              <Skeleton variant="rounded" width={"100%"} sx={{ pt: 2 }} />
            </Grid2>
            <Grid2
              container
              justifyContent={"center"}
              size={2}
              alignItems={"center"}
              flexDirection={"column"}
              pt={2}
            >
              <Skeleton variant="circular" height={120} width={120} />
              <Skeleton variant="rounded" width={"100%"} sx={{ pt: 2 }} />
            </Grid2>
            <Grid2
              container
              justifyContent={"center"}
              size={2}
              alignItems={"center"}
              flexDirection={"column"}
              pt={2}
            >
              <Skeleton variant="circular" height={120} width={120} />
              <Skeleton variant="rounded" width={"100%"} sx={{ pt: 2 }} />
            </Grid2>
            <Grid2
              container
              justifyContent={"center"}
              size={2}
              alignItems={"center"}
              flexDirection={"column"}
              pt={2}
            >
              <Skeleton variant="circular" height={120} width={120} />
              <Skeleton variant="rounded" width={"100%"} sx={{ pt: 2 }} />
            </Grid2>
            <Grid2
              container
              justifyContent={"center"}
              size={2}
              alignItems={"center"}
              flexDirection={"column"}
              pt={2}
            >
              <Skeleton variant="circular" height={120} width={120} />
              <Skeleton variant="rounded" width={"100%"} sx={{ pt: 2 }} />
            </Grid2>
            <Grid2
              container
              justifyContent={"center"}
              size={2}
              alignItems={"center"}
              flexDirection={"column"}
              pt={2}
            >
              <Skeleton variant="circular" height={120} width={120} />
              <Skeleton variant="rounded" width={"100%"} sx={{ pt: 2 }} />
            </Grid2>
            <Grid2
              container
              justifyContent={"center"}
              size={2}
              alignItems={"center"}
              flexDirection={"column"}
            >
              <Skeleton variant="circular" height={120} width={120} />
              <Skeleton variant="rounded" width={"100%"} sx={{ pt: 2 }} />
            </Grid2>
            <Grid2
              container
              justifyContent={"center"}
              size={2}
              alignItems={"center"}
              flexDirection={"column"}
            >
              <Skeleton variant="circular" height={120} width={120} />
              <Skeleton variant="rounded" width={"100%"} sx={{ pt: 2 }} />
            </Grid2>
            <Grid2
              container
              justifyContent={"center"}
              size={2}
              alignItems={"center"}
              flexDirection={"column"}
            >
              <Skeleton variant="circular" height={120} width={120} />
              <Skeleton variant="rounded" width={"100%"} sx={{ pt: 2 }} />
            </Grid2>
            <Grid2
              container
              justifyContent={"center"}
              size={2}
              alignItems={"center"}
              flexDirection={"column"}
            >
              <Skeleton variant="circular" height={120} width={120} />
              <Skeleton variant="rounded" width={"100%"} sx={{ pt: 2 }} />
            </Grid2>
            <Grid2
              container
              justifyContent={"center"}
              size={2}
              alignItems={"center"}
              flexDirection={"column"}
            >
              <Skeleton variant="circular" height={120} width={120} />
              <Skeleton variant="rounded" width={"100%"} sx={{ pt: 2 }} />
            </Grid2>
            <Grid2
              container
              justifyContent={"center"}
              size={2}
              alignItems={"center"}
              flexDirection={"column"}
            >
              <Skeleton variant="circular" height={120} width={120} />
              <Skeleton variant="rounded" width={"100%"} sx={{ pt: 2 }} />
            </Grid2>
          </Grid2>
        ) : (
          <Box
            sx={{
              display: "flex",
              flexWrap: "wrap",
              justifyContent: "space-between",
            }}
          >
            {categories &&
              categories.map((category, index) => (
                <Box
                  key={index}
                  sx={{
                    width: "calc(16.66% )", // Ba cột mỗi hàng, trừ khoảng cách
                    padding: 2,
                    textAlign: "center",
                    display: "flex",
                    flexDirection: "column",
                    alignItems: "center",
                  }}
                >
                  <Avatar
                    alt={category.name}
                    src={Path.publicApp(category.image_path)}
                    sx={{
                      width: 150,
                      height: 150,
                      cursor: "pointer",
                    }}
                    onClick={() => {
                      navigate(Path.products() + `?category=${category.id}`);
                    }}
                  />
                  <Typography variant="body2">{category.name}</Typography>
                </Box>
              ))}
          </Box>
        )}
      </PaperCustom>
    </Container>
  );
};

export default CategoryList;
