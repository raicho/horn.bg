import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import inject from "@rollup/plugin-inject";

const adminCssPath = path.resolve(__dirname, 'bundles/Admin/Resources/css/admin.css');
const adminJsPath = path.resolve(__dirname, 'bundles/Admin/Resources/js/admin.js');

const siteCssPath = path.resolve(__dirname, 'resources/css/app.css');
const siteJsPath = path.resolve(__dirname, 'resources/js/app.js');

const inputFiles = [
    // css admin //
    adminCssPath,
    // js admin //
    adminJsPath,
    // css site //
    siteCssPath,
    // js site //
    siteJsPath
];

export default defineConfig({
    build: {
        outDir: './public_html/build/'
    },
    plugins: [
        laravel({
            input: inputFiles,
            refresh: true,
        }),
        inject({   // => that should be first under plugins array
            $: 'jquery',
            jQuery: 'jquery',
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap')
        }
    }
});
