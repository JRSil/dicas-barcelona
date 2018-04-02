var gulp = require('gulp');
var sass = require('gulp-sass');
var rename = require('gulp-rename');
var useref = require('gulp-useref');
var uglify = require('gulp-uglify');
var gulpIf = require('gulp-if');
var cssnano = require('gulp-cssnano');

/*
 * Variables
 */

// Sass Source
var scssFiles = './src/scss/style.scss';

// CSS Destination
var cssDest = './css';

// Options for production
var sassProdOptions = {
	outputStyle: 'compressed'
}

// Default task - Run with command 'gulp'
gulp.task('default', ['sassprod', 'watch']);

gulp.task('sassprod', function() {
	return gulp.src(scssFiles)
		.pipe(sass(sassProdOptions).on('error', sass.logError))
		.pipe(rename('style.min.css'))
		.pipe(gulp.dest(cssDest));
});

gulp.task('watch', function() {
	gulp.watch(scssFiles, ['sassprod']);
});

// BUILD
gulp.task('build',['useref','images','fonts'], function() {
	console.log('Building files');
});

gulp.task('useref', function() {
	return gulp.src('./*.html')
		.pipe(useref())
		.pipe(gulpIf('./js/*.js', uglify()))
		.pipe(gulp.dest('dist'))
		.pipe(gulpIf('./css/*.css', cssnano()))
    	.pipe(gulp.dest('dist'))
});

gulp.task('images', function() {
	return gulp.src('src/img/**/*.+(png|jpg|gif|svg)')
	.pipe(gulp.dest('dist/img'))
});

gulp.task('fonts', function() {
	return gulp.src('src/fonts/**/*')
	.pipe(gulp.dest('dist/fonts'))
});