import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/assets/css/app.css",
                "resources/assets/js/app.js",
                "resources/assets/css/backend-plugin.min.css",
                "resources/assets/css/backend.css?v=1.0.0",
                "resources/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css",
                "resources/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css",
                "resources/assets/vendor/remixicon/fonts/remixicon.css",
                "resources/assets/js/backend-bundle.min.js",
                "resources/assets/js/table-treeview.js",
                "resources/assets/js/customizer.js",
                "resources/assets/js/chart-custom.js",
                "resources/assets/js/pos-app.js",
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ["**/storage/framework/views/**"],
        },
    },
});
