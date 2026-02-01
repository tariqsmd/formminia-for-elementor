const gulp       = require( 'gulp' );
const cleanCSS   = require( 'gulp-clean-css' );
const rename     = require( 'gulp-rename' );
const wpPot      = require( 'gulp-wp-pot' );
const zip        = require( 'gulp-zip' );
const sourcemaps = require( 'gulp-sourcemaps' );
//const sass        = require( 'gulp-sass' )( require( 'sass' ) );
// Use the modern API by specifying the 'sass' compiler explicitly
const sass        = require( 'gulp-sass' )( require( 'sass-embedded' ) );
const merge       = require( 'merge-stream' );
const browserSync = require( 'browser-sync' ).create(); // 1

// BrowserSync Init
gulp.task( 'serve', function ( done ) {
    browserSync.init( {
        proxy  : "http://fse.local/", // 2
        notify : false
    } );
    done(); // Signal completion
} )

// Compile SCSS and Minify
gulp.task( 'styles', function () {
    // Admin styles
    const admin = gulp.src( 'assets/admin/scss/*.scss' )
    .pipe( sourcemaps.init() )
    .pipe( sass().on( 'error', sass.logError ) )
    .pipe( gulp.dest( 'assets/admin/css' ) )
    .pipe( cleanCSS() )
    .pipe( rename( { suffix : '.min' } ) )
    .pipe( sourcemaps.write( './' ) ) // Writes maps to the same folder
    .pipe( gulp.dest( 'assets/admin/css' ) )
    .pipe( browserSync.stream() ); // 3

    // Public styles
    const public = gulp.src( 'assets/scss/*.scss' )
    .pipe( sourcemaps.init() )
    .pipe( sass().on( 'error', sass.logError ) )
    .pipe( gulp.dest( 'assets/css' ) )
    .pipe( cleanCSS() )
    .pipe( rename( { suffix : '.min' } ) )
    .pipe( sourcemaps.write( './' ) )
    .pipe( gulp.dest( 'assets/css' ) )
    .pipe( browserSync.stream() ); // 3

    return require( 'merge-stream' )( admin, public );
} );

// Generate POT file
gulp.task( 'translate', function () {
    return gulp.src( ['**/*.php', '!node_modules/**', '!vendor/**'] )
    .pipe( wpPot( {
        domain  : 'mtforms',
        package : 'MTForms'
    } ) )
    .pipe( gulp.dest( 'languages/mtforms.pot' ) );
} );

// Zip the plugin
gulp.task( 'zip', function () {
    return gulp.src( [
        '**',
        '!node_modules/**',
        '!node_modules',
        '!gulpfile.js',
        '!package.json',
        '!package-lock.json',
        '!.gitignore',
        '!.git/**',
        '!.git',
        '!.vscode/**',
        '!mtforms.zip'
    ] )
    .pipe( zip( 'mtforms.zip' ) )
    .pipe( gulp.dest( '.' ) );
} );

// Watch Task
gulp.task( 'watch', function ( done ) {
    browserSync.init( {
        proxy  : "http://fse.local/",
        notify : false,
        open   : true // Automatically opens the browser
    } )

    // Watch SCSS
    gulp.watch( 'assets/**/*.scss', gulp.series( 'styles' ) );

    gulp.watch( 'assets/**/*.scss' ).on( 'change', function () {
        browserSync.reload();
    } );

    // Watch PHP files and reload browser
    gulp.watch( '**/*.php' ).on( 'change', function () {
        browserSync.reload();
    } );

    done(); // Signal completion
} );

// Default Task
gulp.task( 'default', gulp.series( 'styles', 'translate', 'zip' ) );

