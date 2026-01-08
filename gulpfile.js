const gulp = require('gulp');
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');
const wpPot = require('gulp-wp-pot');
const zip = require('gulp-zip');
const sass = require('gulp-sass')(require('sass'));

// Compile SCSS and Minify
gulp.task('styles', function () {
    // Admin styles
    const admin = gulp.src('assets/admin/scss/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('assets/admin/css'))
        .pipe(cleanCSS())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('assets/admin/css'));

    // Public styles
    const public = gulp.src('assets/scss/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('assets/css'))
        .pipe(cleanCSS())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('assets/css'));

    return require('merge-stream')(admin, public);
});

// Generate POT file
gulp.task('translate', function () {
    return gulp.src(['**/*.php', '!node_modules/**', '!vendor/**'])
        .pipe(wpPot({
            domain: 'mtforms',
            package: 'MTForms'
        }))
        .pipe(gulp.dest('languages/mtforms.pot'));
});

// Zip the plugin
gulp.task('zip', function () {
    return gulp.src([
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
    ])
        .pipe(zip('mtforms.zip'))
        .pipe(gulp.dest('.'));
});

// Watch Task
gulp.task('watch', function () {
    gulp.watch('assets/**/*.scss', gulp.series('styles'));
});

// Default Task
gulp.task('default', gulp.series('styles', 'translate', 'zip'));

