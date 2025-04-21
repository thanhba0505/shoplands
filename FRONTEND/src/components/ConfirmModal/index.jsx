import { Box, Button } from "@mui/material";
import ModalCustom from "~/components/ModalCustom";
import ButtonLoading from "../ButtonLoading";

const ConfirmModal = ({ open, setOpen, loading, handleAccept }) => {
  return (
    <ModalCustom
      open={open}
      handleClose={() => setOpen(false)}
      title="Duyệt người bán"
    >
      <Box sx={{ display: "flex", justifyContent: "center", gap: 2, mt: 1 }}>
        <Button
          size="large"
          variant="outlined"
          color="error"
          sx={{ width: "50%" }}
          onClick={() => setOpen(false)} // Đóng modal khi nhấn hủy
        >
          Hủy
        </Button>
        <ButtonLoading
          size="large"
          variant="contained"
          sx={{ width: "50%" }}
          onClick={() => {
            handleAccept(); // Thực hiện hành động khi nhấn duyệt
            setOpen(false); // Đóng modal
          }}
          loading={loading}
        >
          Duyệt
        </ButtonLoading>
      </Box>
    </ModalCustom>
  );
};

export default ConfirmModal;
