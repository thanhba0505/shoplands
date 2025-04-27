import { Box, Button } from "@mui/material";
import ModalCustom from "~/components/ModalCustom";
import ButtonLoading from "../ButtonLoading";

const ConfirmModal = ({
  open,
  setOpen,
  loading,
  handleAccept,
  modelTitle,
  subtitle,
  cencelTitle = "Hủy",
  acceptTitle = "Xác nhận",
  ...props
}) => {
  return (
    <ModalCustom
      open={open}
      handleClose={() => setOpen(false)}
      title={modelTitle}
      subtitle={subtitle}
      {...props}
    >
      <Box sx={{ display: "flex", justifyContent: "center", gap: 2, mt: 1 }}>
        <Button
          size="large"
          variant="outlined"
          color="error"
          sx={{ width: "50%" }}
          onClick={() => setOpen(false)} // Đóng modal khi nhấn hủy
        >
          {cencelTitle}
        </Button>
        <ButtonLoading
          size="large"
          variant="contained"
          sx={{ width: "50%" }}
          onClick={() => {
            handleAccept(); 
          }}
          loading={loading}
        >
          {acceptTitle}
        </ButtonLoading>
      </Box>
    </ModalCustom>
  );
};

export default ConfirmModal;
