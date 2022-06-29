const mix = require('laravel-mix');
var path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/maps.js', 'public/js')
    .js('resources/js/chart/data.js', 'public/js/chart')
    .js('resources/js/chart/config.js', 'public/js/chart')
    .js('resources/js/chart/init.js', 'public/js/chart')
    .sourceMaps()
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);

if (mix.inProduction()) {
    mix.version();
}

mix.webpackConfig({
    resolve: {
        // Leaflet image Alias resolutions
        alias: {
            'images/layers.png': path.resolve(__dirname, './node_modules/leaflet/dist/images/layers.png'),
            'images/layers-2x.png': path.resolve(__dirname, './node_modules/leaflet/dist/images/layers-2x.png'),
            'images/marker-icon.png': path.resolve(__dirname, './node_modules/leaflet/dist/images/marker-icon.png'),
            'images/marker-icon-2x.png': path.resolve(__dirname, './node_modules/leaflet/dist/images/marker-icon-2x.png'),
            'images/marker-shadow.png': path.resolve(__dirname, './node_modules/leaflet/dist/images/marker-shadow.png')
        }
    }
});