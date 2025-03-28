import { Container, Box, Typography, Avatar } from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Path from "~/helpers/Path";
import axiosDefault from "~/utils/axiosDefault";

const CategoryList = () => {
  const navigate = useNavigate();
  const [categories, setCategories] = useState([]);

  const fetchCarts = useCallback(async () => {
    try {
      const response = await axiosDefault.get(Api.categories());
      setCategories(response.data);
    } catch (error) {
      if (error.response) {
        navigate(Path.login());
      }
    }
  }, [navigate]);

  useEffect(() => {
    fetchCarts();
  }, [fetchCarts]);

  return (
    <Container maxWidth="lg">
      <PaperCustom>
        <Typography variant="h6" sx={{ mt: 2 }} textAlign={"center"}>
          Danh mục sản phẩm
        </Typography>
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
      </PaperCustom>
    </Container>
  );
};

export default CategoryList;
