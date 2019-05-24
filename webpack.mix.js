const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js([
        'resources/js/app.js',
        'node_modules/sweetalert/dist/sweetalert.min.js',
        'node_modules/selectize/dist/js/standalone/selectize.min.js'
    ], 'public/js').version();
mix.sass('resources/sass/app.scss', 'public/css').version();
mix.styles([
        'public/css/utilize.css',
        'node_modules/selectize/dist/css/selectize.bootstrap3.css'
    ], 'public/css/all.css');
