import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { loadEnv } from 'vite';

export default defineConfig(({ mode }) => {
    // โหลดค่าจากไฟล์ .env
    const env = loadEnv(mode, process.cwd(), '');

    return {
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
            }),
        ],
        // ตั้งค่า base URL จาก APP_URL ใน .env.prod เมื่อเป็น production
        base: mode === 'production' ? env.APP_URL + '/' : '/',
        build: {
            outDir: 'public/build',
            manifest: true,
            rollupOptions: {
                output: {
                    manualChunks: undefined,
                },
            },
        },
        // ตั้งค่าเซิร์ฟเวอร์เฉพาะโหมดพัฒนา
        server: mode !== 'production' ? {
            host: '0.0.0.0',
            port: 5173,
            hmr: {
                host: env.VITE_PUSHER_HOST || 'localhost',  // ใช้ IP สาธารณะ
                port: env.VITE_PUSHER_PORT || 5173,
            },
        } : undefined,
    };
});
