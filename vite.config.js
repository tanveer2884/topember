import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
    ],
    build: {
        rollupOptions: {
            output: {
                globals: {
                    jQuery: 'jQuery'
                }
            }
        },
        chunkSizeWarningLimit: 2000,
        outDir: 'public/tallAdmin'
    }
});
