import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',

                'resources/js/customer/catalog.js',
                'resources/js/customer/ongkos-kirim.js',
                'resources/js/customer/show.js',

                'resources/js/admin/product.js',
                'resources/js/admin/admin-layouts.js',
            ],

            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0',
        hmr: {
            host: '192.168.1.12', 
        },
        cors: true,
    },
});

