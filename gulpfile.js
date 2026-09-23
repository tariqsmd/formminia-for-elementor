const gulp = require('gulp');
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');
const wpPot = require('gulp-wp-pot');
const zip = require('gulp-zip');
const sourcemaps = require('gulp-sourcemaps');
const sass = require('gulp-sass')(require('sass-embedded'));
const merge = require('merge-stream');
const browserSync = require('browser-sync').create();

// BrowserSync Configuration
const bsConfig = {
    proxy: process.env.WP_PROXY || 'http://localhost/', // Set WP_PROXY to your local site URL
    notify: true, // Show "Connected" message to confirm it's working
    open: true,
    ghostMode: {
        clicks: true,
        forms: true,
        scroll: true
    }
};

// --- Tasks ---

// Compile SCSS and Inject CSS into the browser
gulp.task('styles', function () {
    // Admin styles
    const admin = gulp.src('assets/admin/scss/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({ outputStyle: 'expanded' }).on('error', sass.logError))
        .pipe(gulp.dest('assets/admin/css'))
        .pipe(browserSync.stream()) // Stream unminified immediately
        .pipe(cleanCSS())
        .pipe(rename({ suffix: '.min' }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('assets/admin/css'))
        .pipe(browserSync.stream()); // Stream minified immediately

    // Public styles
    const public = gulp.src('assets/scss/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({ outputStyle: 'expanded' }).on('error', sass.logError))
        .pipe(gulp.dest('assets/css'))
        .pipe(browserSync.stream()) // Stream unminified immediately
        .pipe(cleanCSS())
        .pipe(rename({ suffix: '.min' }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('assets/css'))
        .pipe(browserSync.stream()); // Stream minified immediately

    return merge(admin, public);
});

// Generate POT file for translation
gulp.task('translate', function () {
    return gulp.src(['**/*.php', '!node_modules/**', '!vendor/**', '!dist/**'])
        .pipe(wpPot({
            package: 'Quick & Modern Forms for Elementor'
        }))
        .pipe(gulp.dest('languages/quick-modern-forms-for-elementor.pot'));
});

// Zip the plugin for distribution
gulp.task('zip', function () {
    return gulp.src([
        '**',
        '!node_modules/**',
        '!node_modules',
        '!gulpfile.js',
        '!package.json',
        '!package-lock.json',
        '!composer.json',
        '!composer.lock',
        '!vendor/**',
        '!vendor',
        '!README.md',
        '!.gitignore',
        '!.git/**',
        '!.git',
        '!.vscode/**',
        '!.vscode',
        '!dist/**',
        '!dist',
        '!assets/**/*.scss',
        '!**/*.map'
    ])
        .pipe(zip('quick-modern-forms-for-elementor.zip'))
        .pipe(gulp.dest('dist'));
});

// Prepare an upload-ready zip of the plugin (excludes dev/build files)
gulp.task('dist', function () {
    return gulp.src([
        '**',
        '!node_modules/**',
        '!node_modules',
        '!gulpfile.js',
        '!package.json',
        '!package-lock.json',
        '!composer.json',
        '!composer.lock',
        '!vendor/**',
        '!vendor',
        '!README.md',
        '!.gitignore',
        '!.git/**',
        '!.git',
        '!.vscode/**',
        '!.vscode',
        '!dist/**',
        '!dist',
        '!assets/**/*.scss',
        '!**/*.map'
    ])
        .pipe(zip('quick-modern-forms-for-elementor.zip'))
        .pipe(gulp.dest('dist'));
});

// --- BrowserSync / Watch tasks ---

// Task to manually reload the browser
gulp.task('reload', function (done) {
    browserSync.reload();
    done();
});

// Watch Task: Starts BrowserSync and watches for file changes
gulp.task('watch', function (done) {
    browserSync.init(bsConfig);

    // Watch SCSS files: run 'styles' then inject
    gulp.watch('assets/**/*.scss', gulp.series('styles'));

    // Watch PHP files: reload page
    gulp.watch('**/*.php', gulp.series('reload'));

    // Watch JS files: reload page
    gulp.watch('assets/**/*.js', gulp.series('reload'));

    // Watch Image files: reload page
    gulp.watch('assets/images/**/*', gulp.series('reload'));

    done();
});

// Alias for watch
gulp.task('serve', gulp.series('watch'));

// Default Task
gulp.task('default', gulp.series('styles', 'translate', 'zip'));
