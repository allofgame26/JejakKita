import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/filament/admin/theme.css'
            ],
            content: [
                "/vendor/backstage/filament-2fa/resources/**.*.blade.php",
            ],
            refresh: true,
        }),
    ],
});
