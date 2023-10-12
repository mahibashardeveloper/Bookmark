import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";
export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/scss/bookmark/style.scss',
                'resources/js/bookmark/app.js'
            ],
            refresh: true,
        }),
    ],
});
