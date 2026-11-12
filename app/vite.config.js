import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [
    laravel({
      input: [
        "resources/css/app.css",
        "resources/js/app.ts",
        "resources/css/filament/admin/theme.css",
        "resources/css/storefront/base.css",
        "resources/css/storefront/about-us.css",
        "resources/css/storefront/blog.css",
        "resources/css/storefront/cart.css",
        "resources/css/storefront/contacts.css",
        "resources/css/storefront/header.css",
        "resources/css/storefront/home-female.css",
        "resources/css/storefront/home-laboratory.css",
        "resources/css/storefront/home-newsletter.css",
        "resources/css/storefront/home-slider.css",
        "resources/css/storefront/home.css",
        "resources/css/storefront/login.css",
        "resources/css/storefront/post.css",
        "resources/css/storefront/product.css",
        "resources/css/storefront/reviews.css",
        "resources/css/storefront/shop.css",
        "resources/css/storefront/user-dashboard.css",
        "resources/js/storefront/main.ts",
        "resources/js/storefront/home.ts",
        "resources/js/storefront/product.ts",
      ],
      refresh: true,
    }),
    tailwindcss(),
  ],
  server: {
    host: "0.0.0.0",
    port: 5173,
    hmr: {
      host: "localhost",
    },
  },
});
