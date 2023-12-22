import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        outDir: '../../public/build-nc',
        emptyOutDir: true,
        manifest: true,
    },
    plugins: [
        laravel({
            publicDirectory: '../../public',
            buildDirectory: 'build-nc',
            input: [
                __dirname + '/Resources/assets/css/app.css',
                __dirname + '/Resources/assets/js/app.js'
            ],
            refresh: true,
        }),
    ],
});

//export const paths = [
//    'Modules/$STUDLY_NAME$/resources/assets/sass/app.scss',
//    'Modules/$STUDLY_NAME$/resources/assets/js/app.js',
//];
