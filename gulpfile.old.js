const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const browserSync = require("browser-sync").create();
const concat = require("gulp-concat");
const babel = require("gulp-babel");
const uglify = require("gulp-uglify");
const { deleteAsync } = require("del");

// Paths configuration
const paths = {
  main: {
    src: "./assets/css/main.css",
    dest: "./assets/css/",
  },
  scss: {
    src: "./assets/scss/*.scss",
    watch: "./assets/scss/**/*.scss",
    dest: "./assets/css/",
  },
  css: {
    libs: "./assets/css/libs/*.css",
    dest: "./assets/css/",
  },
  js: {
    scripts: "./assets/js/scripts/*.js",
    libs: "./assets/js/libs/*",
    dest: "./assets/js/",
  },
  php: [
    "*.php",
    "./includes/**/*.php",
    "./templates/**/*.php",
    "./parts/**/*.php",
  ],
};

// PostCSS plugins configuration
const postcssPlugins = [
  require("@tailwindcss/postcss"),
  autoprefixer({
    cascade: false,
    grid: true,
  }),
];

// PostCSS plugins for production
const postcssPluginsProd = [
  require("@tailwindcss/postcss"),
  autoprefixer({
    cascade: false,
    grid: true,
  }),
  require("cssnano")({
    preset: [
      "default",
      {
        discardComments: {
          removeAll: true,
        },
        normalizeWhitespace: false,
      },
    ],
  }),
];

// Compile main CSS file (Tailwind + SCSS combined)
function compilaMain() {
  const isProduction = process.env.NODE_ENV === "production";
  const plugins = isProduction ? postcssPluginsProd : postcssPlugins;

  return gulp
    .src(paths.main.src)
    .pipe(postcss(plugins))
    .pipe(gulp.dest(paths.main.dest))
    .pipe(browserSync.stream({ match: "**/*.css" }));
}

// Compile main CSS for development (uncompressed)
function compilaMainDev() {
  return gulp
    .src(paths.main.src)
    .pipe(postcss(postcssPlugins))
    .pipe(gulp.dest(paths.main.dest))
    .pipe(browserSync.stream({ match: "**/*.css" }));
}

// Concatenate CSS plugins
function pluginsCSS() {
  return gulp
    .src(paths.css.libs)
    .pipe(concat("plugins.css"))
    .pipe(gulp.dest(paths.css.dest))
    .pipe(browserSync.stream());
}

// Process JavaScript files
function gulpJs() {
  return gulp
    .src(paths.js.scripts)
    .pipe(concat("all.js"))
    .pipe(
      babel({
        presets: ["@babel/env"],
        compact: true,
      })
    )
    .pipe(
      uglify({
        compress: {
          drop_console: true, // Remove console.log in production
          drop_debugger: true,
        },
      })
    )
    .pipe(gulp.dest(paths.js.dest))
    .pipe(browserSync.stream());
}

// Development JavaScript (without uglify)
function gulpJsDev() {
  return gulp
    .src(paths.js.scripts)
    .pipe(concat("all.js"))
    .pipe(
      babel({
        presets: ["@babel/env"],
      })
    )
    .pipe(gulp.dest(paths.js.dest))
    .pipe(browserSync.stream());
}

// Concatenate JavaScript plugins
function pluginsJs() {
  return gulp
    .src(paths.js.libs)
    .pipe(concat("plugins.js"))
    .pipe(gulp.dest(paths.js.dest))
    .pipe(browserSync.stream());
}

// Browser Sync configuration
function browser() {
  browserSync.init({
    proxy: "localhost:8000", // Altere para o seu domínio local
    open: false,
    notify: false,
    host: "localhost",
    port: 3000,
    ui: {
      port: 3001,
    },
    // Performance optimizations
    ghostMode: {
      clicks: true,
      forms: true,
      scroll: true,
    },
    // File watching optimizations
    watchOptions: {
      ignoreInitial: true,
      ignored: ["node_modules/**", ".git/**"],
    },
  });
}

// Watch files for changes
function watch() {
  // Watch SCSS files
  gulp.watch(paths.scss.watch, { usePolling: false }, compilaSassDev);

  // Watch CSS library files
  gulp.watch(paths.css.libs, { usePolling: false }, pluginsCSS);

  // Watch PHP files
  gulp.watch(
    paths.php,
    { usePolling: false },
    gulp.series(compilaSassDev, (done) => {
      browserSync.reload();
      done();
    })
  );

  // Watch JavaScript files
  gulp.watch(paths.js.scripts, { usePolling: false }, gulpJsDev);
  gulp.watch(paths.js.libs, { usePolling: false }, pluginsJs);
}

// Clean task (optional)
function clean() {
  return deleteAsync([
    paths.scss.dest + "style.css",
    paths.scss.dest + "tailwind-base.css", // Remove o arquivo antigo também
    paths.js.dest + "all.js",
    paths.js.dest + "plugins.js",
  ]);
}

// Task definitions
gulp.task("sass", compilaSass);
gulp.task("sass:dev", compilaSassDev);
gulp.task("plugincss", pluginsCSS);
gulp.task("alljs", gulpJs);
gulp.task("alljs:dev", gulpJsDev);
gulp.task("pluginjs", pluginsJs);
gulp.task("browser-sync", browser);
gulp.task("watch", watch);
gulp.task("clean", clean);

// Complex tasks
gulp.task(
  "build",
  gulp.series(
    "clean",
    gulp.parallel("sass", "plugincss", "alljs", "pluginjs")
  )
);

gulp.task(
  "dev",
  gulp.series(
    "clean",
    gulp.parallel("sass:dev", "plugincss", "alljs:dev", "pluginjs"),
    gulp.parallel("browser-sync", "watch")
  )
);

// Default task
gulp.task("default", gulp.series("dev"));
