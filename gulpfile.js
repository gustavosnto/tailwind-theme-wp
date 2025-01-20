const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const tailwindcss = require('tailwindcss');
const autoprefixer = require('autoprefixer');
const browserSync = require('browser-sync').create();
const concat = require('gulp-concat');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');

function compilaSass() {
  return gulp.src('./assets/scss/*.scss')
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(postcss([tailwindcss('./tailwind.config.js'), autoprefixer()]))
    .pipe(gulp.dest('./assets/css/'))
    .pipe(browserSync.stream());
}

gulp.task('sass', compilaSass);

function pluginsCSS() {
  return gulp.src('./assets/css/libs/*.css')
  .pipe(concat('plugins.css'))
  .pipe(gulp.dest('./assets/css/'))
  .pipe(browserSync.stream())
}

gulp.task('plugincss', pluginsCSS);

function gulpJs() {
  return gulp.src('./assets/js/scripts/*.js')
  .pipe(concat('all.js'))
  .pipe(babel({
      presets: ['@babel/env']
  }))
  .pipe(uglify())
  .pipe(gulp.dest('./assets/js/'))
  .pipe(browserSync.stream());
}

gulp.task('alljs', gulpJs);

function pluginsJs() {
  return gulp
  .src(['./assets/js/libs/*'])
  .pipe(concat('plugins.js'))
  .pipe(gulp.dest('./assets/js/'))
  .pipe(browserSync.stream())
}

gulp.task('pluginjs', pluginsJs);

function browser() {
  browserSync.init({
    proxy: 'dominio.local'
  })
}

gulp.task('browser-sync', browser);

function watch() {
  gulp.watch('./assets/scss/**/*.scss', compilaSass);
  gulp.watch('./assets/css/libs/*.css', pluginsCSS);
  gulp.watch(['*.php', './includes/**/*.php', './templates/**/*.php', './parts/**/*.php'], gulp.series(compilaSass, (done) => {
    browserSync.reload();
    done();
  }));
  gulp.watch('./assets/js/scripts/*.js', gulpJs);
  gulp.watch('./assets/js/libs/*.js', pluginsJs);
}

gulp.task('watch', watch);

gulp.task('default', gulp.parallel('watch', 'browser-sync', 'sass', 'plugincss', 'alljs', 'pluginjs'));
