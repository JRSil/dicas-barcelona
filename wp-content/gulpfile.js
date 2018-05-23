var gulp = require('gulp');
var uglify = require('gulp-uglify');
var pump = require('pump');

gulp.task('default', function (cb) {
    pump([
        gulp.src([
            'plugins/**/*.js', 
            '!plugins/accelerated-mobile-pages/includes/admin-script.js', 
            '!plugins/accelerated-mobile-pages/pagebuilder/inc/admin-amp-page-builder.js',
            '!plugins/kirki/modules/field-dependencies/field-dependencies.js',
            '!plugins/kirki/modules/tooltips/tooltip.js'
        ]),
        uglify(),
        gulp.dest('dist')
        ],
        cb
    );
});