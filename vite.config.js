import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/style.scss', 'resources/ts/app.ts'],
            refresh: true,
        }),
    ],
});
