import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    base: 'http://34.143.197.151/',
    server: {
        host: '0.0.0.0', // Allow external access
        port: 5173,
        hmr: {
            host: '34.143.197.151', // Your server's public IP address
            port: 5173
        }
    }
});
