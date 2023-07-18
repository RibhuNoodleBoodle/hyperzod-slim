const mix = require('laravel-mix');
require('laravel-mix-vue3');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .vue()
   .version();
