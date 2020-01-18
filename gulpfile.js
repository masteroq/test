var sass = require('gulp-sass');
var gulp = require('gulp'); 
gulp.task('sass', function () {
 
    gulp.src('./assets/scss/style.scss')
 
        .pipe(sass())
 
        .pipe(gulp.dest('./'));
 
});
