const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const browserSync = require('browser-sync').create();
const concat = require('gulp-concat');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const cssnano = require('cssnano');

// Caminhos para os arquivos
const paths = {
  styles: {
    assets: './assets/scss/**/*.scss',
    dest: './assets/css/'
  },
  scripts: {
    assets: './assets/js/scripts/**/*.js',
    dest: './assets/js/'
  },
  plugins: {
    css: './assets/css/libs/*.css',
    js: './assets/js/libs/*.js'
  },
  php: [
    '*.php',
    './includes/**/*.php',
    './templates/**/*.php',
    './parts/**/*.php'
  ]
};

// Compilando Sass, adicionando autoprefixer e minificando
function compilaSass() {
  return gulp.src(paths.styles.src)
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(autoprefixer({
      overrideBrowserslist: ['last 2 versions'],
      cascade: false,
    }))
    .pipe(cssnano())
    .pipe(gulp.dest(paths.styles.dest))
    .pipe(browserSync.stream());
}

// Processando CSS de plugins
function pluginsCSS() {
  return gulp.src(paths.plugins.css)
    .pipe(concat('plugins.css'))
    .pipe(cssnano())
    .pipe(gulp.dest(paths.styles.dest))
    .pipe(browserSync.stream());
}

// Processando JS customizado
function gulpJs() {
  return gulp.src(paths.scripts.src)
    .pipe(concat('all.js'))
    .pipe(babel({ presets: ['@babel/env'] }))
    .pipe(uglify())
    .pipe(gulp.dest(paths.scripts.dest))
    .pipe(browserSync.stream());
}

// Processando JS de plugins
function pluginsJs() {
  return gulp.src(paths.plugins.js)
    .pipe(concat('plugins.js'))
    .pipe(uglify())
    .pipe(gulp.dest(paths.scripts.dest))
    .pipe(browserSync.stream());
}

// Configurando o BrowserSync
function browser() {
  browserSync.init({
    proxy: 'dominio.local', // Substitua pelo seu domínio local
    notify: false
  });
}

// Observando mudanças nos arquivos
function watchFiles() {
  gulp.watch(paths.styles.src, compilaSass);
  gulp.watch(paths.plugins.css, pluginsCSS);
  gulp.watch(paths.php).on('change', browserSync.reload);
  gulp.watch(paths.scripts.src, gulpJs);
  gulp.watch(paths.plugins.js, pluginsJs);
}

// Definindo tarefas do Gulp
gulp.task('sass', compilaSass);
gulp.task('plugincss', pluginsCSS);
gulp.task('alljs', gulpJs);
gulp.task('pluginjs', pluginsJs);
gulp.task('browser-sync', browser);
gulp.task('watch', watchFiles);

gulp.task('default', gulp.parallel('watch', 'browser-sync', 'sass', 'plugincss', 'alljs', 'pluginjs'));
