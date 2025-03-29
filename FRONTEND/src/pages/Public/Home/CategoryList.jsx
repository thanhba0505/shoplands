import { Container, Box, Typography, Avatar } from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import CircularProgressLoading from "~/components/CircularProgressLoading";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import axiosDefault from "~/utils/axiosDefault";

const CategoryList = () => {
  const [categories, setCategories] = useState([]);
  const [loading, setLoading] = useState(false);

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
          <CircularProgressLoading sx={{ height: 400 }} />
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
                      // navigate(Path.category(category.slug));
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
