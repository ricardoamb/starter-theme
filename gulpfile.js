// Gulp Plugins Requires
var gulp = require('gulp'),
    rename = require('gulp-rename'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    sourcemaps = require('gulp-sourcemaps'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify');

// Style Tasks Require
var styleSource = 'src/sass/app.sass',
    styleDist = './assets/css/',
    styleWatch = 'src/sass/**/**/*.sass';

var themeSource = 'sass/style.scss',
    themeDist = './',
    themeWatch = 'sass/**/**/*.scss';

gulp.task('theme', function(){
    // Compile CSS
    gulp.src (themeSource)
        .pipe ( sourcemaps.init() )
        .pipe ( sass({
            errorLogToConsole : true,
            outputStyle: 'compressed'
        }) )
        .on ( 'error' , console.error.bind( console ) )
        .pipe ( autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }) )
        .pipe (rename( { suffix: '' } ) )
        .pipe ( sourcemaps.write( './' ) )
        .pipe ( gulp.dest (themeDist) );
});

// Theme Common Style
gulp.task('style', function(){
    // Compile CSS
    gulp.src (styleSource)
        .pipe ( sourcemaps.init() )
        .pipe ( sass({
            errorLogToConsole : true,
            outputStyle: 'compressed'
        }) )
        .on ( 'error' , console.error.bind( console ) )
        .pipe ( autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }) )
        .pipe (rename( { suffix: '.min' } ) )
        .pipe ( sourcemaps.write( './' ) )
        .pipe ( gulp.dest (styleDist) );
});