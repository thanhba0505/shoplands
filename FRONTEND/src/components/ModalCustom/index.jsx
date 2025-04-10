import React from "react";
import { Box, Modal, Typography } from "@mui/material";
import PaperCustom from "~/components/PaperCustom";

const ModalCustom = React.forwardRef(
  (
    {
      open,
      handleClose,
      title,
      subtitle,
      children,
      sx,
      alignTitle = "center",
      alignSubtitle = "center",
      ...props
    },
    ref
  ) => {
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
            <Typography
              id="modal-modal-title"
              variant="h5"
              component="h2"
              align={alignTitle}
              fontWeight={"bold"}
              lineHeight={1}
              textTransform={"uppercase"}
            >
              {title}
            </Typography>

            {subtitle ? (
              <Typography
                id="modal-modal-description"
                sx={{ mt: 2 }}
                lineHeight={1}
                align={alignSubtitle}
              >
                {subtitle}
              </Typography>
            ) : (
              <></>
            )}

            <Box sx={{ mt: 3, maxHeight: "calc(100vh - 200px)", overflowY: "auto", px: 1 }}>
              {children}
            </Box>
          </PaperCustom>
        </Box>
      </Modal>
    );
  }
);

ModalCustom.displayName = "ModalCustom"; // Optional: To improve debugging output

export default ModalCustom;
