import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  accessToken: null,
  refreshToken: null,
  account: null,
};

const authSlice = createSlice({
  name: "auth",
  initialState,
  reducers: {
    loginSuccess: (state, action) => {
      state.accessToken = action.payload.access_token;
      state.refreshToken = action.payload.refresh_token;
      state.account = action.payload.account;
    },

    logout: () => initialState,

    refreshTokenSuccess: (state, action) => {
      state.accessToken = action.payload.access_token;
      state.refreshToken = action.payload.refresh_token;
      state.account = action.payload.account;
    },

    updateUserAvatar: (state, action) => {
      state.account.avatar = action.payload;
    },

    updateUserName: (state, action) => {
      state.account.name = action.payload;
    },
  },
});

export const {
  loginSuccess,
  logout,
  refreshTokenSuccess,
  updateUserAvatar,
  updateUserName,
} = authSlice.actions;
export default authSlice.reducer;
