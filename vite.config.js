import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    base: '/build/',
    build: {
        assetsDir: '', // <- esta línea pone los archivos directamente en /build
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/css/auth.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
