//noinspection JSAnnotator
const { mix } = require('laravel-mix');

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

/*mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css'); */

mix.sass('resources/assets/sass/app.scss', 'public/css');

mix.styles('resources/assets/css/lity.min.css', 'public/css/lity.min.css')
    .scripts('resources/assets/js/lity.js', 'public/js/lity.js');


