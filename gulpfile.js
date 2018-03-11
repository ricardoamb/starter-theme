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

var jsDist = './assets/js/';
var jsWatch = 'src/js/**/**/*.js';
var jsDependencies = [
    './js/navigation.js',
    './js/skip-link-focus-fix.js',
    './js/jquery.min.js',
    './src/js/app.js'
];

gulp.task('js', function() {
    gulp.src(jsDependencies)
        .pipe ( sourcemaps.init( { loadMaps: true } ) )
        .pipe ( concat('app.min.js') ) // concat pulls all our files together before minifying them
        .pipe ( uglify() )
        .pipe ( sourcemaps.write( './' ) )
        .pipe ( gulp.dest(jsDist) )
});

gulp.task ( 'default' , [
    'theme',
    'style',
    'js'
]);

gulp.task('watch',['default'],function(){
    gulp.watch(themeWatch,['theme']);
    gulp.watch(styleWatch,['style']);
    gulp.watch(jsWatch,['js']);
});