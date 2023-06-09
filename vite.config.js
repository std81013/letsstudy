import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/main.js', 'resources/css/main.css', 'resources/js/pw-encryption.js',
            'resources/js/activity-detail.js', 'resources/js/form-validate.js', 'resources/js/datepicker.js', 'resources/js/fileupload.js'],
            refresh: true,
        }),
    ], optimizeDeps: {
        include: ['jquery', 'uikit', '@fortawesome/fontawesome-free', 'bootstrap', 'crypto-js', 'jquery-filepond', 'jquery-validation', 'flatpickr']
    }
});
