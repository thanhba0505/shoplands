import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  seller_id: null,
  cart_ids: [],
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

    reset: () => initialState,
  },
});

export const { setCartIds, setSellerId, reset } = orderSlice.actions;
export default orderSlice.reducer;
