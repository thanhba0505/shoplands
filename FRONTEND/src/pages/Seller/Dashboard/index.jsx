import { Grid2 } from "@mui/material";
import PaperCustom from "~/components/PaperCustom";

const Dashboard = () => {
  return (
    <Grid2 container spacing={2}>
      <Grid2 size={12}>
        <PaperCustom sx={{ height: "500px", backgroundColor: "gray" }}>ádlfj</PaperCustom>
      </Grid2>
      <Grid2 size={6}>
        <PaperCustom sx={{ height: "500px", backgroundColor: "gray" }}>ádlfj</PaperCustom>
      </Grid2>
      <Grid2 size={6}>
        <PaperCustom sx={{ height: "500px", backgroundColor: "gray" }}>ádlfj</PaperCustom>
      </Grid2>
    </Grid2>
  );
};

export default Dashboard;
