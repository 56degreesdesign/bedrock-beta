const mix = require('laravel-mix');
const local = require('./assets/js/utils/local-config');
const critical = require('critical-css-generator');

require('laravel-mix-tailwind');

mix.setPublicPath('./build');

mix.webpackConfig({
    externals: {
        "jquery": "jQuery",
    }
});

module.exports = {
    resolve: {
        alias: {
            vue: mix.inProduction() ? 'vue/dist/vue.min.js' : 'vue/dist/vue.js'
        }
    }
}

if (local.proxy) {
    mix.browserSync({
        proxy: local.proxy,
        injectChanges: true,
        open: false,
        files: [
            'build/**/*.{css,js}',
            'templates/**/*.php'
        ]
    });
}

mix.tailwind();
mix.js('assets/js/app.js', 'js').vue();
mix.sass('assets/scss/app.scss', 'css').options({
    processCssUrls: false
});

mix.options({
    postCss: [
        require('autoprefixer'),
    ],
});

if (mix.inProduction()) {
    // mix.versionHash();
    mix.sourceMaps();
    critical.generate({
        url: local.proxy,
        path: 'critical.css',
        viewport: true
    });
}