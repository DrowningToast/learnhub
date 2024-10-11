import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // Allow external access from any network
        port: 5173,
        hmr: {
            host: '34.143.197.151', // Your server's public IP address
            port: 5173,
            protocol: 'ws', // WebSocket protocol for HMR
        },
    },
});
