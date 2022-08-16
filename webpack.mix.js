const mix = require('laravel-mix');

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

/* 【原先】 */
// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);



/* 所有前端應用的配置，讀取 resources的檔案，最後在做build的時候會將內容都放置到 public資料夾中。 */
/* 【New】 */
mix.js("resources/js/app.js", "public/js").vue({ version: 2 })
    .sass("resources/sass/app.scss", "public/css")