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
        host: '0.0.0.0', // Allow external access
        port: parseInt(process.env.VITE_PORT || '5173'),
        strictPort: true, // Ensure Vite uses this port only
        hmr: {
            host: process.env.VITE_PUSHER_HOST || 'localhost', // Use public IP in production
            port: parseInt(process.env.VITE_PUSHER_PORT || '5173'),
            protocol: 'ws', // WebSocket protocol for HMR
        },
    },
});
