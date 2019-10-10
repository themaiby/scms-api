const mix = require('laravel-mix');
const path = require("path");

mix
  .ts("resources/vue/main.ts", "public/js/app.js")
  .webpackConfig({

    output: { chunkFilename: "js/[name].js?id=[chunkhash]" },

    resolve: {
      alias: {
        vue$: "vue/dist/vue.runtime.esm.js",
        "@": path.resolve("resources/vue")
      },
    },
  })
  .version();


mix.options({
  hmrOptions: {
    host: 'localhost',
    port: 8080
  }
});
