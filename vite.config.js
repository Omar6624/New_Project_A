import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0', // or your local IP
        port: 5176,
        strictPort: true,
        cors: true, // ✅ allow cross-origin requests
        hmr: {
            host: '192.168.16.122', // ✅ your LAN IP
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
