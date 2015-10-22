var gulp = require("gulp");
var bower = require("gulp-bower");
var elixir = require("laravel-elixir");
// var modernizr = require("gulp-modernizr");


// gulp.task('modernizr', function() {
//   gulp.src('./*.js')
//     .pipe(modernizr())
//     .pipe(gulp.dest("build/"))
// });
gulp.task('bower', function() {
    return bower();
});

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

var paths = {
    'jquery': 'vendor/jquery-legacy/dist',
    'bootstrap': 'vendor/bootstrap-sass/assets',
    'bootswatch': 'vendor/bootswatch',
    'fontawesome': 'vendor/font-awesome',
    'metisMenu': 'vendor/metisMenu/dist',
    'colorbox': 'vendor/jquery-colorbox',
    'dataTables': 'vendor/datatables/media',
    'dataTablesBootstrap3Plugin': 'vendor/datatables-bootstrap3-plugin/media',
    'flag': 'vendor/flag-sprites/dist',
    'mask': 'vendor/jQuery-Mask-Plugin',
    'masks_def': 'vendor/js',
    'validation': 'vendor/jsvalidation/js/',
    'select2': 'vendor/select2/',
    'datepicker': '/vendor/bootstrap3-datepicker-gulp/',
    'modernizr' : 'vendor/js'
    // 'datepicker': '/vendor/bootstrap-datepicker/dist/'
    // 'mask': 'vendor/igorescobar-jQuery-Mask-Plugin-535b4e4'
};

elixir.config.sourcemaps = false;

elixir(function (mix) {

    // Run bower install
    mix.task('bower');
    // mix.task('modernizr');

    // mix.copy('resources/' + paths.mask, 'public/js');

    // Copy fonts straight to public
    mix.copy('resources/' + paths.bootstrap + '/fonts/bootstrap/**', 'public/fonts');
    mix.copy('resources/' + paths.fontawesome + '/fonts/**', 'public/fonts');

    // Copy images straight to public
    mix.copy('resources/' + paths.colorbox + '/example3/images/**', 'public/img');

    // Copy flag resources
    mix.copy('resources/' + paths.flag + '/css/flag-sprites.min.css', 'public/css/flags.css');
    mix.copy('resources/' + paths.flag + '/img/flags.png', 'public/img/flags.png');

    // JsValidation: PUBLIC TO RESOURCES
    mix.copy('./public/vendor/jsvalidation/js', 'resources/' + paths.validation + '/');

    // Datepicker: PUBLIC TO RESOURCES
    mix.copy('./public/vendor/bootstrap3-datepicker-gulp/', 'resources/' + paths.datepicker + '/');

    // mix.copy('resources/' + paths.select2 + '/css/', 'public/css/');

    // TESTE COM O GULP
    mix.sass('shop.scss', 'resources/assets/build/shop.css');
    mix.styles([
        'assets/build/shop.css'
    ], 'public/css/shop.css', 'resources/');

    // Compile SASS and output to default resource directory
    mix.sass('site.scss', 'resources/assets/build/site.css', {
        includePaths: [
            // paths.datepicker + '/css/bootstrap-datepicker.css',
            'resources/' + paths.datepicker + '/scss/',
            'resources/' + paths.bootstrap + '/stylesheets/',
            'resources/' + paths.bootswatch + '/',
            'resources/' + paths.fontawesome + '/scss/',
            // 'resources/' + paths.select2 + '/css/',
        ]
    });


    // Merge Site CSSs.
    mix.styles([
        paths.colorbox + '/example3/colorbox.css',
        'assets/build/site.css' // Note: site.css is generated by sass and has some overrides.
    ], 'public/css/site.css', 'resources/');

    // Merge Site scripts.
    mix.scripts([
        paths.jquery + '/jquery.js',
        paths.bootstrap + '/javascripts/bootstrap.js',
        paths.colorbox + '/jquery.colorbox.js',
        paths.mask + '/jquery.mask.js',
        paths.masks_def + '/masks_def.js',
        paths.validation + '/jsvalidation.js',
        paths.datepicker + '/js/bootstrap-datepicker.js',
        paths.datepicker + '/js/locales/bootstrap-datepicker.pt-BR.js',
        paths.modernizr + '/modernizr-custom.js'

        // paths.select2 + '/js/select2.min.js',
    ], 'public/js/site.js', 'resources/');

    // Compile SASS and output to default resource directory.
    mix.sass('admin.scss', 'resources/assets/build/admin.css', {
        includePaths: [
            'resources/' + paths.bootswatch + '/'
        ]
    });

    // Merge Admin CSSs.
    mix.styles([
        paths.dataTablesBootstrap3Plugin + '/css/datatables-bootstrap3.css',
        paths.metisMenu + '/metisMenu.css',
        'assets/build/admin.css' // Note: admin.css is generated by sass and has some overrides.
    ], 'public/css/admin.css', 'resources/');

    // Merge Admin scripts.
    mix.scripts([
        paths.dataTables + '/js/jquery.dataTables.js',
        paths.dataTablesBootstrap3Plugin + '/js/datatables-bootstrap3.js',
        paths.metisMenu + '/metisMenu.js'
    ], 'public/js/admin.js', 'resources/');

    // Cache-bust all.css and all.js files.
    mix.version([
        'css/site.css',
        'css/admin.css',
        'css/shop.css',
        'js/site.js',
        'js/admin.js'
    ]);
});

