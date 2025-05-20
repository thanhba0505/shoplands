import { TabContext, TabList } from "@mui/lab";
import { Box, Tab } from "@mui/material";
import { useEffect, useState } from "react";
import { useNavigate, useParams } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import Path from "~/helpers/Path";
import ListProduct from "./ListProduct";

const Products = () => {
  const navigate = useNavigate();
  const params = useParams();

  const [loading, setLoading] = useState(false);
  const value = params.pageName || "all";

  useEffect(() => {
    const validStatuses = ["all", "active", "locked"];

    if (!validStatuses.includes(value)) {
      navigate(Path.sellerProducts("all"));
    }
  }, [value, navigate]);

  const handleChange = (event, newValue) => {
    navigate(Path.adminProducts(newValue));
  };

  const renderComponent = () => {
    switch (value) {
      case "all":
        return (
          <ListProduct loading={loading} setLoading={setLoading} status="all" />
        );
      case "active":
        return (
          <ListProduct
            loading={loading}
            setLoading={setLoading}
            status="active"
          />
        );
      case "locked":
        return (
          <ListProduct
            loading={loading}
            setLoading={setLoading}
            status="locked"
          />
        );
    }
  };

  return (
    <PaperCustom>
      <Box sx={{ width: "100%", typography: "body1" }}>
        <TabContext value={value}>
          <Box sx={{ borderBottom: 1, borderColor: "divider" }}>
            <TabList onChange={handleChange} aria-label="lab API tabs example">
              <Tab disabled={loading} label="Tất cả sản phẩm" value="all" />
              <Tab disabled={loading} label="Còn hoạt động" value="active" />
              <Tab disabled={loading} label="Đã bị khóa" value="locked" />
            </TabList>
          </Box>
        </TabContext>
      </Box>

      {renderComponent()}
    </PaperCustom>
  );
};

export default Products;
