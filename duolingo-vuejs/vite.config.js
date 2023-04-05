import { fileURLToPath, URL } from 'node:url'
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueJsx from '@vitejs/plugin-vue-jsx'
import dotenv from 'dotenv'

// Load environment variables from .env file
dotenv.config()

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue(), vueJsx()],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  },
  build: {
    rollupOptions: {
      external: ['/images/4eb7c316f1956d8aff95611c08778667.svg']
    }
  },
  define: {
    // Define environment variables for use in client-side code
    'process.env': {
      NODE_ENV: process.env.NODE_ENV,
      API_URL: process.env.API_URL,
      // add more variables as needed
    }
  }
})
