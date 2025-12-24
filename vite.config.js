import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    server: {
        // Allow cross-origin requests so module workers can load from Vite
        cors: true,
        // Use IPv4 localhost to avoid [::1] vs 127.0.0.1 mismatches
        host: '127.0.0.1',
        hmr: { host: '127.0.0.1' },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
