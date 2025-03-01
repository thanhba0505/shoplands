import { combineReducers, configureStore } from "@reduxjs/toolkit";
import authSlice from "./authSlice";
import loadingSlice from "./loadingSlice";

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
});

const persistedReducer = persistReducer(persistConfig, rootReducer);

const store = configureStore({
    reducer: persistedReducer,
    middleware: (getDefaultMiddleware) =>
        getDefaultMiddleware({
            serializableCheck: {
                ignoredActions: [
                    FLUSH,
                    REHYDRATE,
                    PAUSE,
                    PERSIST,
                    PURGE,
                    REGISTER,
                ],
            },
        }),
});

export let persistor = persistStore(store);
export default store;
