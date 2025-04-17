import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from 'tailwindcss'; // Import Tailwind CSS directly
import autoprefixer from 'autoprefixer'; // Import Autoprefixer directly

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/login.js',
                'resources/js/register.js',
                'resources/js/profile.js',
                'resources/js/jobs.js',
                'resources/js/employer.js'
                
            ],
            refresh: true,
        }),
    ],
    css: {
        postcss: {
            plugins: [
                tailwindcss(), // Use Tailwind CSS as a PostCSS plugin
                autoprefixer(), // Use Autoprefixer
            ],
        },
    },
    build: {
        manifest: true, // Ensure the manifest file is generated
        outDir: 'public/build/', // Ensure the output directory is correct
        emptyOutDir: true, // Clear the output directory before building
    },
});
