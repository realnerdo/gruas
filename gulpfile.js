'use strict';

var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    concat = require('gulp-concat'),
    livereload = require('gulp-livereload'),
    theme = 'public/wp-content/themes/gruasexpress/';

gulp.task('sass', function(){
    return gulp.src([
            theme + 'sass/master.sass',
            'node_modules/glidejs/dist/css/glide.core.min.css',
            'node_modules/glidejs/dist/css/glide.theme.min.css'
        ])
            .pipe(sass().on('error', sass.logError))
            .pipe(concat('style.css'))
            .pipe(autoprefixer())
            .pipe(gulp.dest(theme))
            .pipe(livereload());
});

gulp.task('scripts', function(){
    return gulp.src([
            'node_modules/jquery/dist/jquery.min.js',
            'node_modules/glidejs/dist/glide.min.js',
            'node_modules/gmaps/gmaps.min.js',
            'node_modules/imagesloaded/imagesloaded.pkgd.min.js',
            theme + 'js/src/scripts.js'
        ])
            .pipe(concat('scripts.js'))
            .pipe(gulp.dest(theme + 'js/dist'))
            .pipe(livereload());
});

gulp.task('watch', function(){
    livereload.listen();
    gulp.watch([theme + 'sass/style.sass', theme + 'sass/**'], ['sass']);
    gulp.watch(theme + 'js/src/scripts.js', ['scripts']);
});
