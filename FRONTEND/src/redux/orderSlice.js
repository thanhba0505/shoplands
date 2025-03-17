import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  seller_id: null,
  cart_ids: [],
  path_qr: null,
  order_id: null,
};

const orderSlice = createSlice({
  name: "order",
  initialState,
  reducers: {
    setCartIds: (state, action) => {
      state.cart_ids = action.payload;
    },

    setSellerId: (state, action) => {
      state.seller_id = action.payload;
    },

    setQrAndOrderId: (state, action) => {
      state.path_qr = action.payload.pathQr;
      state.order_id = action.payload.orderId;
    },

    reset: () => initialState,
  },
});

export const { setCartIds, setSellerId, setQrAndOrderId, reset } = orderSlice.actions;
export default orderSlice.reducer;
