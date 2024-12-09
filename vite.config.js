import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/polls.css',
                'resources/css/account.css',
                "resources/css/login.css",
                "resources/css/comments.css",
                "resources/css/reset.css",
                "resources/css/variables.css"
            ],
            refresh: true,
        }),
    ],
    server: {
        host: "0.0.0.0",
        https: false
    },
    base: '/build/'
});
