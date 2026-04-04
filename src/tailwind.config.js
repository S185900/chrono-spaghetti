/** @type {import('tailwindcss').Config} */
const glob = require('fast-glob');

module.exports = {
  content: [
    // これがないとコンポーネントの中身を見に行かない！
    // resources/views 配下のすべての .blade.php ファイルをチェック
    "/resources/views/**/*.blade.php",
    // path.join(__dirname, "./resources/views/**/*.blade.php"),

    // JSは src フォルダなど、コンパイル前のソースコードだけを指定する
    // もし resources/js/app.js（ビルド済み）を拾ってしまうとループする
    "/resources/js/app.js",

    // "/resources/**/*.js",
    // path.join(__dirname, "./resources/js/**/*.js"),
    // "/resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        'baloo': ['"Baloo Chettan 2"', 'Inter', 'sans-serif'],
      },
      colors: {
        'brand': {
          'primary': '#ff8c00',
          'secondary': '#150029',
        },
      },
    },
  },
  plugins: [],
}