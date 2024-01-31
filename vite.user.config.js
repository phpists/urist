import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/user/sass/main.sass', 'resources/user/js/main.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/user/js',
        },
    },
    build: {
        manifest: false,
        reportCompressedSize: true,
        cssCodeSplit: false,
        minify: true,
        outDir: 'public/user/build',
        assetsDir: '.',
        rollupOptions: {
            input: {
                app: 'resources/user/js/main.js'
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
