import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        if (id.includes('@tiptap')) {
                            return 'vendor-tiptap';
                        }
                        if (id.includes('leaflet')) {
                            return 'vendor-leaflet';
                        }
                        if (id.includes('alpinejs')) {
                            return 'vendor-alpine';
                        }
                    }
                }
            }
        },
        chunkSizeWarningLimit: 600,
    },
    server: {
        cors: true,
        hmr: {
            host: 'localhost',
            port: 5173,
        },
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
