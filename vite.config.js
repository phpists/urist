import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/main.sass', 'resources/js/main.js'],
            refresh: true,
        }),
    ],
    build: {
        manifest: false,
        reportCompressedSize: true,
        cssCodeSplit: false,
        minify: true,
        outDir: 'public/build',
        assetsDir: '.',
        rollupOptions: {
            input: {
                app: 'resources/js/main.js'
            },
            output: {
                entryFileNames: 'main.js',
                assetFileNames: 'main.css',
            },
        },
        terserOptions: {
            compress: {
                drop_console: true,
            },
        },
    },
});
