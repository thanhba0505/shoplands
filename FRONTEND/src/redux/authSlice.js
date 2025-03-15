import { createSlice } from "@reduxjs/toolkit";

const authSlice = createSlice({
  name: "auth",
  initialState: {
    accessToken: null,
    refreshToken: null,
    account: null,
    addresses: [],
  },
  reducers: {
    loginSuccess: (state, action) => {
      state.accessToken = action.payload.access_token;
      state.refreshToken = action.payload.refresh_token;
      state.account = action.payload.account;
    },

    logout: (state) => {
      state.accessToken = null;
      state.refreshToken = null;
      state.account = null;
    },

    refreshTokenSuccess: (state, action) => {
      state.accessToken = action.payload.access_token;
      state.refreshToken = action.payload.refresh_token;
      state.account = action.payload.account;
    },

    setAddresses: (state, action) => {
      state.addresses = action.payload;
    },
  },
});

export const { loginSuccess, logout, refreshTokenSuccess, setAddresses } = authSlice.actions;
export default authSlice.reducer;
