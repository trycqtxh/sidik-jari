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

mix
    //.js('resources/assets/js/siswa.js', 'public/js')
    //.js('resources/assets/js/home.js', 'public/js')
    //.js('resources/assets/js/guru.js', 'public/js')
    .js('resources/assets/js/absensi.js', 'public/js')
    //.js('resources/assets/js/kelas.js', 'public/js')
    //.copy('node_modules/pace-js/pace.min.js', 'public/js')
    //.copy('node_modules/pace-js/themes/blue/pace-theme-flash.css', 'public/css')
   	//.sass('resources/assets/sass/app.scss', 'public/css');
