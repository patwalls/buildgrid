var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('site.scss')
        .sass('app.scss')
        .browserify('app.js')
        .browserify('site.js')
        .version([
            'public/css/site.css',
            'public/css/app.css',
            'public/js/site.js',
            'public/js/app.js'
        ])
        .styles([
            'vendor/animate.css'
        ], 'public/css/vendor.css');
});
