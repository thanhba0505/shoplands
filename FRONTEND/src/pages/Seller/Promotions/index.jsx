import { TabContext, TabList } from "@mui/lab";
import { Box, Tab } from "@mui/material";
import { useEffect, useState } from "react";
import { useNavigate, useParams } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import Path from "~/helpers/Path";
import NewCoupon from "./NewCoupon";
import Coupons from "./Coupons";

const Promotions = () => {
  const navigate = useNavigate();
  const params = useParams();

  const [loading, setLoading] = useState(true);
  const value = params.page || "coupon";

  useEffect(() => {
    const validStatuses = ["coupon", "expired", "new"];

    if (!validStatuses.includes(value)) {
      navigate(Path.sellerPromotions("coupon"));
    }
  }, [value, navigate]);

  const handleChange = (event, newValue) => {
    navigate(Path.sellerPromotions(newValue));
  };

  const renderComponent = () => {
    switch (value) {
      case "coupon":
        return <Coupons setLoading={setLoading} loading={loading} />;
      case "expired":
        return <Coupons setLoading={setLoading} loading={loading} expired={true} />;
      case "new":
        return <NewCoupon />;
    }
  };
  return (
    <PaperCustom sx={{ px: 3 }}>
      <Box sx={{ width: "100%", typography: "body1" }}>
        <TabContext value={value}>
          <Box sx={{ borderBottom: 1, borderColor: "divider" }}>
            <TabList onChange={handleChange} aria-label="lab API tabs example">
              <Tab disabled={loading} label="Mã giảm giá" value="coupon" />
              <Tab disabled={loading} label="Mã hết hạn" value="expired" />
              <Tab disabled={loading} label="Thêm mã mới" value="new" />
            </TabList>
          </Box>
        </TabContext>
      </Box>

      {renderComponent()}
    </PaperCustom>
  );
};

export default Promotions;
