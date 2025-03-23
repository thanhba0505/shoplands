import { combineReducers, configureStore } from "@reduxjs/toolkit";
import authSlice from "./authSlice";
import loadingSlice from "./loadingSlice";
import orderSlice from "./orderSlice";
import tokenSlice from "./tokenSlice";

import {
  persistStore,
  persistReducer,
  FLUSH,
  REHYDRATE,
  PAUSE,
  PERSIST,
  PURGE,
  REGISTER,
} from "redux-persist";

import storage from "redux-persist/lib/storage";

// Lưu cả khi reload hoặt thoát trình duyệt
const persistConfig = {
  key: "auth", // Chỉ lưu state auth
  storage,
};

const rootReducer = combineReducers({
  auth: authSlice,
  loading: loadingSlice,
  order: orderSlice,
  token: tokenSlice,
});

const persistedReducer = persistReducer(persistConfig, rootReducer);

const store = configureStore({
  reducer: persistedReducer,
  middleware: (getDefaultMiddleware) =>
    getDefaultMiddleware({
      serializableCheck: {
        ignoredActions: [FLUSH, REHYDRATE, PAUSE, PERSIST, PURGE, REGISTER],
      },
    }),
});

export let persistor = persistStore(store);
export default store;
