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
        outDir: 'public/build', // Main output directory
        assetsDir: '.', // Assets directory relative to outDir
        rollupOptions: {
            output: {
                entryFileNames: 'main.js', // Output path for the bundled JS file
                assetFileNames: 'main.css', // Output path for the bundled CSS file
            },
        },
        minify: true, // Enable minification
        terserOptions: {
            compress: {
                drop_console: true, // Remove console.log statements in production
            },
        },
    },
});
