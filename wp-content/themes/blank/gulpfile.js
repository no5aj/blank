var gulp = require('gulp'),
		sass = require('gulp-sass'),
    watch = require('gulp-watch'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    minifyCSS = require('gulp-minify-css');
 
gulp.task('default', function() {
  // place code for your default task here
});

gulp.task('sass', function() {
  gulp.src('./static/css/scss/*.scss')
    .pipe(sass({ errLogToConsole:true }))
    .pipe(rename('style.css'))
    .pipe(gulp.dest('./static/css'))
    .pipe(minifyCSS())
    .pipe(rename('style.min.css'))
    .pipe(gulp.dest('./static/css'));
});
 
gulp.task('minify-css', function() {
  gulp.src('./static/css/style.css')
    .pipe(minifyCSS({keepBreaks:true}))
    .pipe(rename('style.min.css'))
    .pipe(gulp.dest('./static/css'))
});

gulp.task('compress', function() {
  gulp.src(['./static/js/src/modernizr.js', './static/js/src/functions.js'])
    .pipe(concat('functions.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./static/js'))
});

gulp.task('watch', function() {
  gulp.watch('./static/css/scss/*.scss', ['sass']);
  gulp.watch('./static/js/src/*.js', ['compress']);
});