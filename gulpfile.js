const fs = require('fs');
const path = require('path');
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

// Read the plugin version from the main plugin file header
// (e.g. " * Version:           1.0.0") so SVN tags always match the release version.
function getPluginVersion() {
    const mainFile = fs.readdirSync('.').find(function (f) {
        return f.endsWith('.php') && /Plugin Name:/.test(fs.readFileSync(f, 'utf8'));
    });
    const content = fs.readFileSync(mainFile, 'utf8');
    const match = content.match(/^\s*\*\s*Version:\s*([0-9][0-9a-zA-Z.\-]*)\s*$/m);
    return match ? match[1] : '0.0.0';
}

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
            package: 'FormMinia for Elementor'
        }))
        .pipe(gulp.dest('languages/formminia-for-elementor.pot'));
});

// Zip the plugin for distribution
gulp.task('zip', function () {
    return gulp.src(distSources)
        .pipe(zip('formminia-for-elementor.zip'))
        .pipe(gulp.dest('dist'));
});

// Files that ship to WordPress.org (excludes dev/build files)
// See: https://developer.wordpress.org/plugins/wordpress-org/how-to-use-subversion/
const distSources = [
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
];

// The *.map files are excluded from dist, so the sourceMappingURL comment
// left in the compiled CSS would point at a file that is never shipped.
// Strip it from the dist copies so the released plugin has no dangling
// reference (the source tree keeps it for local debugging).
function stripSourceMapComments(dir) {
    const cssDir = path.join(dir, 'assets');
    if (!fs.existsSync(cssDir)) {
        return;
    }
    for (const sub of ['css', path.join('admin', 'css')]) {
        const target = path.join(cssDir, sub);
        if (!fs.existsSync(target)) {
            continue;
        }
        for (const file of fs.readdirSync(target)) {
            if (!file.endsWith('.css')) {
                continue;
            }
            const filePath = path.join(target, file);
            const original = fs.readFileSync(filePath, 'utf8');
            const cleaned = original.replace(/\/\*#\s*sourceMappingURL=[^*]*\*\/\s*$/gm, '').trimEnd();
            if (cleaned !== original) {
                fs.writeFileSync(filePath, cleaned);
                console.log('  stripped sourceMappingURL from ' + path.relative('.', filePath));
            }
        }
    }
}

// Prepare a WordPress.org SVN-ready dist layout:
//   dist/trunk/          -> current release code (copy on every build)
//   dist/tags/<version>/ -> named from the plugin header Version, e.g. tags/1.0.0
//   dist/assets/         -> screenshots/banners/icons (kept empty here)
gulp.task('dist', async function () {
    const version = getPluginVersion();
    console.log('Building SVN dist for v' + version);

    const { pipeline } = require('stream/promises');
    await pipeline(gulp.src(distSources), gulp.dest('dist/trunk'));
    await pipeline(gulp.src(distSources), gulp.dest('dist/tags/' + version));

    stripSourceMapComments('dist/trunk');
    stripSourceMapComments(path.join('dist', 'tags', version));
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
