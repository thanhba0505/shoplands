import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  isRefreshing: false,
};

const tokenSlice = createSlice({
  name: "loading",
  initialState,
  reducers: {
    setRefreshing: (state, action) => {
      state.isRefreshing = action.payload;
    },

    reset: () => initialState,
  },
});

export const { setRefreshing, reset } = tokenSlice.actions;
export default tokenSlice.reducer;
