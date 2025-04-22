import {
  MaterialDesignContent,
  SnackbarProvider,
  useSnackbar,
} from "notistack";
import CheckCircleIcon from "@mui/icons-material/CheckCircle";
import ErrorIcon from "@mui/icons-material/Error";
import CloseIcon from "@mui/icons-material/Close";
import styled from "@emotion/styled";
import Grow from "../Grow";
import { IconButton } from "@mui/material";

const StyledMaterialDesignContent = styled(MaterialDesignContent)(
  ({ theme }) => ({
    "&.notistack-MuiContent-success": {
      backgroundColor: theme.palette.primary.main,
    },
    "&.notistack-MuiContent-error": {
      backgroundColor: theme.palette.error.main,
    },
    "&.notistack-MuiContent-info": {
      backgroundColor: theme.palette.info.main,
    },
    "&.notistack-MuiContent-warning": {
      backgroundColor: theme.palette.warning.main,
    },
  })
);

const SnackbarProviderCustom = ({ children }) => {
  return (
    <SnackbarProvider
      TransitionComponent={Grow}
      maxSnack={3}
      anchorOrigin={{ vertical: "bottom", horizontal: "right" }}
      autoHideDuration={2000}
      variant={"success"}
      iconVariant={{
        success: <CheckCircleIcon sx={{ mr: 1 }} />,
        error: <ErrorIcon sx={{ mr: 1 }} />,
      }}
      Components={{
        success: StyledMaterialDesignContent,
        error: StyledMaterialDesignContent,
      }}
      action={(key) => <SnackbarAction snackbarKey={key} />}
    >
      {children}
    </SnackbarProvider>
  );
};

const SnackbarAction = ({ snackbarKey }) => {
  const { closeSnackbar } = useSnackbar();

  return (
    <IconButton
      onClick={() => closeSnackbar(snackbarKey)} // Đóng snackbar khi nhấn nút "x"
      color="inherit"
      size="small"
    >
      <CloseIcon />
    </IconButton>
  );
};

export default SnackbarProviderCustom;
