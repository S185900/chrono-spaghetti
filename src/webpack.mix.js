const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        // require('@tailwindcss/postcss')('./tailwind.config.js'),
        // require('tailwindcss')('./tailwind.config.js'),
        // require('autoprefixer'),
        // @tailwindcss/postcss を使用
        require('@tailwindcss/postcss'),
        require('autoprefixer'),
    ]);

// 無限ループ対策：publicフォルダを監視から完全に外す
mix.options({
    watchOptions: {
        ignored: /node_modules|public/
    }
});

mix.webpackConfig({
    watchOptions: {
        ignored: [
            '**/node_modules/**',
            '**/public/**', // publicフォルダ内の変更を一切無視
        ]
    }
});
