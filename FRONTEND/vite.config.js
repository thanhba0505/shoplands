import { defineConfig } from "vite";
import react from "@vitejs/plugin-react-swc";

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [react()],
  resolve: {
    alias: [{ find: "~", replacement: "/src" }],
  },
  define: {
    "process.env": {},
  },
  server: {
    historyApiFallback: true,
  },
  build: {
    outDir: 'dist',
  }
});
