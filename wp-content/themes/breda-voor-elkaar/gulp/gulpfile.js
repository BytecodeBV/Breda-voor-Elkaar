const browserSync = require ('browser-sync');
const gulp = require ('gulp');
const autoprefixer = require ('gulp-autoprefixer');
const babel = require ('gulp-babel');
const cleanCss = require ('gulp-clean-css');
const concat = require ('gulp-concat');
const minify = require ('gulp-minify');
const plumber = require('gulp-plumber');
const sass = require ('gulp-sass');
const sourcemaps = require ('gulp-sourcemaps');
const uglify = require('gulp-uglify');

const source = {
    scss: './style.scss',
    js: './js/script.js'
};

const watch = {
    scss: './scss/**/*.scss',
    js: './js/**/*.js'
}

const output = {
    scss: './dist',
    js: './dist'
};

const plumberSettings = {
    errorHandler: error => {
        console.log(error.message);
        this.emit('end');
    }
}

gulp.task('scss', () => {
     return gulp.src([source.scss])
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(autoprefixer('last 2 versions'))
        .pipe(cleanCss())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(output.scss))
});

gulp.task('js', () => {
    return gulp.src(source.js)
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(babel({presets: ['es2015']}))
        .pipe(concat('custom.js'))
        .on('error', console.error.bind(console))
        .pipe(uglify())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(output.js))
});

gulp.task('default', ['scss', 'js'], () => {
    gulp.watch(watch.scss, ['scss']);
    gulp.watch(watch.js, ['js']);
});

// For later if we need browser sync
// gulp.task('browser-sync', () => {
//     browserSync({
//     });
// });
// gulp.task('default', ['browser-sync'], () => {
//     gulp.watch(source.scss,[scss]);
//     gulp.watch(source.js,[js]);
// });