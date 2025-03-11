import React from "react";
import { Box, Modal, Typography } from "@mui/material";
import PaperCustom from "~/components/PaperCustom";

const ModalCustom = React.forwardRef(
  ({ open, handleClose, title, subtitle, children, sx, ...props }, ref) => {
    return (
      <Modal
        sx={{
          display: "flex",
          alignItems: "center",
          justifyContent: "center",
        }}
        open={open}
        onClose={handleClose}
        aria-labelledby="modal-modal-title"
        aria-describedby="modal-modal-description"
      >
        <Box>
          <PaperCustom
            ref={ref} // Forward ref here
            sx={{
              width: 500,
              p: 4,
              ...sx,
            }}
            {...props}
          >
            <Typography id="modal-modal-title" variant="h6" component="h2">
              {title}
            </Typography>
            <Typography id="modal-modal-description" sx={{ mt: 2 }}>
              {subtitle}
            </Typography>

            {children}
          </PaperCustom>
        </Box>
      </Modal>
    );
  }
);

ModalCustom.displayName = "ModalCustom"; // Optional: To improve debugging output

export default ModalCustom;
