import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    base: '/', // Use APP_URL from .env.prod in production
    build: {
        outDir: 'public/build',
        manifest: true,
        rollupOptions: {
            output: {
                manualChunks: undefined,
            },
        },
    },
    server: {
        host: '0.0.0.0',  // Allow external access by using '0.0.0.0'
        port: 5173,       // You can change the port if necessary
        hmr: {
            host: '34.143.197.151',  // Replace with your actual public IP address
        },
    },
});
