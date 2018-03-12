// Gulp Plugins Requires
var gulp = require('gulp'),
    rename = require('gulp-rename'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    sourcemaps = require('gulp-sourcemaps'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    fs = require('fs');

// Style Tasks Require
var styleSource = 'src/sass/app.sass',
    styleDist = './assets/css/',
    styleWatch = 'src/sass/**/**/**/**/*.sass';

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
var jsonFiles = JSON.parse(fs.readFileSync('./theme.json'));
var jsDependencies = jsonFiles.jsFiles;

gulp.task('js', function() {
    gulp.src(jsDependencies)
        .pipe ( sourcemaps.init( { loadMaps: true } ) )
        .pipe ( concat('app.min.js') ) // concat pulls all our files together before minifying them
        .pipe ( uglify() )
        .pipe ( sourcemaps.write( './' ) )
        .pipe ( gulp.dest(jsDist) )
});

gulp.task('showJson',function(){

});

gulp.task ( 'default' , [
    'style',
    'js'
]);

gulp.task('watch',['default'],function(){
    gulp.watch(styleWatch,['style']);
    gulp.watch(jsWatch,['js']);
});