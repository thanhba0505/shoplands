import { TabContext, TabList } from "@mui/lab";
import { Box, Tab } from "@mui/material";
import { useState } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import Path from "~/helpers/Path";
import ListProduct from "./ListProduct";
import NewProducts from "./NewProducts";

const Inventory = () => {
  return <div>inventory</div>;
};

const ImportProducts = () => {
  return <div>import-products</div>;
};

const Reviews = () => {
  return <div>reviews</div>;
};

const Products = () => {
  const location = useLocation();
  const navigate = useNavigate();

  const [loading, setLoading] = useState(false);
  const value = Path.getElement(location.pathname, 3) ?? "all";

  const handleChange = (event, newValue) => {
    navigate(Path.sellerProducts(newValue));
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
      case "new":
        return <NewProducts />;
      case "inventory":
        return <Inventory />;
      case "import-products":
        return <ImportProducts />;
      case "reviews":
        return <Reviews />;
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
              <Tab disabled={loading} label="Thêm sản phẩm" value="new" />
              <Tab disabled={loading} label="Kho hàng" value="inventory" />
              <Tab
                disabled={loading}
                label="Nhập kho"
                value="import-products"
              />
              <Tab
                disabled={loading}
                label="Đánh giá sản phẩm"
                value="reviews"
              />
            </TabList>
          </Box>
        </TabContext>
      </Box>

      {renderComponent()}
    </PaperCustom>
  );
};

export default Products;
