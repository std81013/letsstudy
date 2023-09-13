import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '$': 'jQuery'
        },
    },
    optimizeDeps: {
        include: ['jquery', 'uikit', '@fortawesome/fontawesome-free', 'bootstrap', 'crypto-js', 'jquery-validation', 'flatpickr', 'quill']
    }
});
