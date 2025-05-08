import { Avatar, Button, Grid2, TextField, Typography } from "@mui/material";
import { useCallback, useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import PaperCustom from "~/components/PaperCustom";
import Api from "~/helpers/Api";
import Auth from "~/helpers/Auth";
import Format from "~/helpers/Format";
import Log from "~/helpers/Log";
import Path from "~/helpers/Path";
import axiosWithAuth from "~/utils/axiosWithAuth";

const Profile = () => {
  const navigate = useNavigate();
  const [loading, setLoading] = useState(false);
  const user = Auth.getUser();

  return (
    <PaperCustom sx={{ px: 3 }}>
      <Grid2 container spacing={4} alignItems={"start"}>
        <Grid2 size={3} container justifyContent={"center"} spacing={2}>
          <Grid2 size={"auto"}>
            <Avatar
              src={Path.publicAvatar(user?.avatar)}
              sx={{ width: 200, height: 200 }}
            >
              {user?.name?.charAt(0).toUpperCase()}
            </Avatar>
          </Grid2>

          <Grid2 size={12}>
            <Button
              variant="outlined"
              color="primary"
              fullWidth
              // onClick={() => navigate(Path.userEdit())}
            >
              Tải ảnh lên
            </Button>
          </Grid2>
        </Grid2>

        <Grid2 container spacing={2} size={9} alignItems={"center"} pt={2}> 
          <Grid2 size={"auto"}>
            <Typography variant="body1">
              <b>Họ tên:</b>
            </Typography>
          </Grid2>

          <Grid2 size={10}>
            <TextField
              variant="outlined"
              autoComplete="off"
              size="small"
              sx={{ width: "300px" }}
              value={user?.name}
              disabled
            />
          </Grid2>

          <Grid2 size={12}>
            <Typography variant="body1">
              <b>Số điện thoại:</b> {user?.phone}
            </Typography>
          </Grid2>

          <Grid2 size={12}>
            <Typography variant="body1">
              <b>Tham gia vào:</b> {Format.formatDate(user?.created_at)}
            </Typography>
          </Grid2>

          <Grid2 size={12}>
            <Typography variant="body1">
              <b>Trạng thái:</b> {Format.formatStatus(user?.status)}
            </Typography>
          </Grid2>
        </Grid2>
      </Grid2>
    </PaperCustom>
  );
};

export default Profile;
