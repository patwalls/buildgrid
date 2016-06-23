var elixir = require('laravel-elixir');


elixir.config.js.browserify.watchify = {
    enabled: true,
    options: {
        poll: true
    }
}

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

        // NPM JS packages
        .browserify('app.js')
        .browserify('admin.js')
        .browserify('site.js')
        .version([
            'public/css/site.css',
            'public/css/app.css',
            'public/js/app.js',
            'public/js/admin.js',
            'public/js/site.js'
        ])

        // 3rd party CSS libraries
        .styles([
            'vendor/animate.css',
            'vendor/ionicons.css',
            'vendor/jquery.bxslider.css'
        ], 'public/css/vendor.css')

        .browserSync({ proxy:'buildgrid.local.com'} );
});
