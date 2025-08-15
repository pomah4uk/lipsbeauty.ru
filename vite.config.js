import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/crm/crm.css',
                'resources/css/public/font-awesome.min.css',
            ],
            refresh: true,
        }),
    ],
});
