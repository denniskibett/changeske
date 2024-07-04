import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  build: {
    manifest: true,
    outDir: 'public/build',
  },
  plugins: [vue()],
});
